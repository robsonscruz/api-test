<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HistoryDeploy;
use AppBundle\Exception\Error;
use AppBundle\Model\HistoryDeployModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Respect\Validation;
use AppBundle\Helper;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @var
     */
    protected $parameters;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $meuIp = shell_exec("cat /etc/hosts | grep $(cat /etc/hostname) | awk '{print $1}' | uniq");
        $content = $this->getDoctrine()->getManager()->getRepository(HistoryDeploy::class)->findBy(
            [],
            ['id' => 'DESC'],
            $limitPage = 10
        );

        // replace this example code with whatever you need
        return $this->render(
            'default/index.html.twig', [
            'content' => $content,
            'meuIp' => $meuIp
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadAction(Request $request)
    {
        $content = $this->getDoctrine()->getManager()->getRepository(HistoryDeploy::class)->findBy(
            [],
            ['id' => 'DESC']
        );

        $response = $this->render(
            'default/list.html.twig',
            ['content' => $content]
        );

        $response->headers->set('Content-Type', 'text/csv');
        $filename = "deploy_list_".date("Y_m_d_His").".csv";
        $response->headers->set('Content-Disposition', 'attachment; filename='.$filename);

        return $response;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    private function validateParameters(Request $request)
    {
        $this->parseRequest($request);
        $this->parameters = $request->request->all();

        try {
            Validation\Validator::arrayType()
                ->key('component', Validation\Validator::notEmpty())
                ->key('version', Validation\Validator::notEmpty())
                ->key('responsible', Validation\Validator::notEmpty())
                ->key('status', Validation\Validator::notEmpty())
                ->assert($this->parameters);

        } catch (Validation\Exceptions\ValidationException $validationException) {
            $error = array_filter($validationException->findMessages([
                'component',
                'version',
                'responsible',
                'status',
            ]));

            Helper\ResponseHelper::response(['error' => Error::INVALID_PARAMETERS, 'content' => $error], 500);
        }

        return true;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Request
     */
    private function parseRequest(Request $request)
    {
        $inputData = file_get_contents("php://input");
        if (!empty($inputData)) {
            $parameters = json_decode($inputData, true);
            foreach ($parameters as $parameter => $value) {
                $request->request->set($parameter, $value);
            }
        }

        return $request;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function deployAction(Request $request)
    {
        $this->validateParameters($request);
        $codeHttp = Helper\HttpHelper::HTTP_STATUS_OK;
        $response = ['success' => true];

        try {
            $history = new HistoryDeploy();
            $history->importFromArray($this->parameters);

            $historyModel = new HistoryDeployModel($this->getDoctrine()->getManager());
            $historyModel->save($history);
        } catch (\Exception $e) {
            $codeHttp = Helper\HttpHelper::HTTP_STATUS_INTERNAL_SERVER_ERROR;
            $response = ['error' => Error::ERROR_SAVE_DATA, 'content' => $e->getMessage()];
        }

        Helper\ResponseHelper::response($response, $codeHttp);
    }
}
