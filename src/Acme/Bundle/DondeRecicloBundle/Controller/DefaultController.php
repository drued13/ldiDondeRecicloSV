<?php

namespace Acme\Bundle\DondeRecicloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\BrowserKit\Response;

use Acme\Bundle\DondeRecicloBundle\Entity\User;

use Acme\Bundle\DondeRecicloBundle\Entity\Point;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use \Exception;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeDondeRecicloBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function userAction(Request $request)
    {
    	$user =new User();
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($user);
    	
    	$form = $this->createFormBuilder($user)
    		->add('fname','text')
    		->add('lname','text')
    		->add('email','text')
    		->add('username','text')
    		->add('password','password')
    		->getForm();
    	if ($request->getMethod() == 'POST') {
    		$form->bind($request);
    		
    		if ($form->isValid()) {
    			$em->flush();
    			return $this->redirect($this->generateUrl('_user_success'));
    		}
    	}
    	return $this->render('AcmeDondeRecicloBundle:Default:user.html.twig', array('form' => $form->createView()));
    }
    
    public function testAction()
    {
    	try
    	{
    		$em = $this->getDoctrine()->getManager();
    		 
    		$user = new User();
    		$user->setFname('Douglas');
    		$user->setLname('Montano');
    		$user->setEmail('drued.13@gmail.com');
    		$user->setPassword('123456');
    		$user->setUsername('drued.13');
    		 
    		$em->persist($user);
    		$em->flush();
    		 
    		return $this->render('AcmeDondeRecicloBundle:Default:test.html.twig',array('result' => 'Exito'));
    	}catch(Exception $e)
    	{
    		return $this->render('AcmeDondeRecicloBundle:Default:test.html.twig',array('result' => 'Fallo'));
    	}
    	
    	
    }
}
