<?php
/**
 * Created by PhpStorm.
 * User: henrique
 * Date: 23/08/16
 * Time: 20:41
 */

namespace App\Route\Cadastro;


use App\Util\Handle;
use App\Util\Handle\DELETE;
use App\Util\Handle\GET;
use App\Util\Handle\POST;
use App\Util\Handle\PUT;
use GuzzleHttp\Exception\TransferException;
use Slim\Http\Request;
use Slim\Http\Response;


class Usuario extends Handle
{
    use GET;
    use POST;
    use PUT;
    use DELETE;


    public function get(Request $request, Response $response)
    {
        /** @var \Twig_Environment $twig */
        /** @var \GuzzleHttp\Client $api */


        $usrID = $request->getAttribute('id');
        $context = [];


        if ($usrID)
        {
            $api = $this->ci->get('API');
            $resp = $api->get("usuarios/{$usrID}");
            if ($resp->getStatusCode() === 204) return $response->withRedirect('/cadastro/usuario');
            $context['usuario'] = json_decode($resp->getBody(), true);
        }


        $twig = $this->ci->get('twig');
        $view = $twig->render('cadastro/usuario/usuario.twig', $context);
        $response->getBody()->write($view);


        return $response;
    }


    public function post(Request $request, Response $response)
    {
        /** @var \GuzzleHttp\Client $api */


        $json = $request->getParsedBody();
        $api = $this->ci->get('API');


        try
        {
            $api->post("usuarios", ['json' => $json]);
        }
        catch (TransferException $e)
        {
            return $response->withStatus($e->getCode());
        }


        return $response;
    }


    public function delete(Request $request, Response $response)
    {
        /** @var \GuzzleHttp\Client $api */


        $usrID = $request->getAttribute('id');
        $api = $this->ci->get('API');


        try
        {
            $api->delete("usuarios/{$usrID}");
        }
        catch (TransferException $e)
        {
            return $response->withStatus($e->getCode());
        }


        return $response;
    }


    public function put(Request $request, Response $response)
    {
        /** @var \GuzzleHttp\Client $api */


        $usrID = $request->getAttribute('id');
        $json = $request->getParsedBody();
        $api = $this->ci->get('API');


        try
        {
            $api->put("usuarios/{$usrID}", ['json' => $json]);
        }
        catch (TransferException $e)
        {
            return $response->withStatus($e->getCode());
        }


        return $response;
    }
}