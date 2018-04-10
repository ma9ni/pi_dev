<?php
/**
 * Created by PhpStorm.
 * User: pc asus
 * Date: 28/03/2018
 * Time: 22:35
 */

namespace AppBundle\Redirection;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

private $router;

    /**
     * @param RouterInterface $router
     */


    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // Get list of roles for current user
        $roles = $token->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);
        // If is a admin or super admin we redirect to the backoffice area
        if (in_array('ROLE_ADMIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('admin_homepage'));
        // otherwise, if is a commercial user we redirect to the crm area
        // elseif (in_array('ROLE_USERS', $rolesTab, true))
        //   $redirection = new RedirectResponse($this->router->generate('p_idev_home'));
        // otherwise we redirect user to the member area
        elseif (in_array('ROLE_VETE', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('f_soin_index'));
        elseif (in_array('ROLE_PET', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('offre_pet'));
        // otherwise we redirect user to the member area
        elseif (in_array('ROLE_DRESS', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('f_dressage_index'));
        // otherwise we redirect user to the member area
        else
            $redirection = new RedirectResponse($this->router->generate('front_end_gallery'));
        return $redirection;
    }
}