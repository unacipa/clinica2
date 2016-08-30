<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 23/08/16
 * Time: 20:41
 */

namespace App\Route;


use App\Util\Handle;
use App\Util\Handle\GET;
use Slim\Http\Request;
use Slim\Http\Response;


class Paciente extends Handle {

    use GET;


    function get(Request $request, Response $response) {

        $pacID = $request->getAttribute('id');

        /** @var \Twig_Environment $twig */
        $twig = $this->ci->get('twig');

        $context = $context = $this->ci->get('settings')['Twig']['context']['sistema'];

        $view = $twig->render('paciente/paciente.twig', $context);

        $response->getBody()->write($view);


        return $response;
    }
}