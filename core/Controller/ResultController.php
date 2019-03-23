<?php

namespace Core\Controller;

use Core\Model\ResultModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ResultController extends Controller
{
    public function findAll(Request $request, Response $response)
    {
        //$results = ResultModel::all();
        $results = ResultModel::orderBy('date_of_measurement', 'desc')->get();
        return $response->withStatus(self::HTTP_200_OK)->withJson($results);
    }

    public function saveResult(Request $request, Response $response)
    {
        $resultModel = new ResultModel();
        $resultModel->dose = $request->getParsedBodyParam('dose');
        $resultModel->unit_dose = $request->getParsedBodyParam('unit_dose');
        $resultModel->voltage = $request->getParsedBodyParam('voltage');
        $resultModel->unit_voltage = $request->getParsedBodyParam('unit_voltage');
        $resultModel->date_of_measurement = $request->getParsedBodyParam('date_of_measurement');
        if ($this->verifyResultModel($resultModel)) {
            $resultModel->save();
            return $response->withStatus(self::HTTP_201_CREATED)->withJson($resultModel);
        }
        return $response->withStatus(self::HTTP_400_BAD_REQUEST);
    }

    public function findCurrentResult(Request $request, Response $response)
    {
        $currentResult = ResultModel::orderBy('date_of_measurement', 'desc')->first();
        return $response->withStatus(self::HTTP_200_OK)->withJson($currentResult);
    }


    private function verifyResultModel($model)
    {
        if ($model->dose != null && is_numeric($model->dose)
            && $model->voltage != null && is_numeric($model->voltage)
            && $model->unit_dose != null && $model->unit_voltage != null && $model->date_of_measurement != null) {
            return true;
        }
        return false;
    }
}