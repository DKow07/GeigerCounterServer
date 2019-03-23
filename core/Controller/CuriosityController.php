<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 15.11.2018
 * Time: 16:44
 */

namespace Core\Controller;

use Core\Model\CuriosityModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CuriosityController extends Controller
{
    public function findAll(Request $request, Response $response)
    {
        $curiosities = CuriosityModel::all();
        return $response->withStatus(self::HTTP_200_OK)->withJson($curiosities);
    }

    public function getRandomCuriosity(Request $request, Response $response)
    {
        $curiosity = CuriosityModel::orderByRaw("RAND()")->first();
        return $response->withStatus(self::HTTP_200_OK)->withJson($curiosity);
    }
}