<?php

namespace Acme\Bundle\DondeRecicloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\BrowserKit\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\Bundle\DondeRecicloBundle\Entity\User;

use Acme\Bundle\DondeRecicloBundle\Entity\Point;

use Acme\Bundle\DondeRecicloBundle\Entity\MaterialPoint;

use Acme\Bundle\DondeRecicloBundle\Entity\MaterialType;

use \Exception;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeDondeRecicloBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function userAction(Request $request)
    {
    	
    	if ($request->getMethod() == 'POST') {
    		try
    		{
    			$user =new User();
    			$em = $this->getDoctrine()->getManager();
    			
    			$user->setFname($request->request->get('fname'));
    			$user->setLname($request->request->get('lname'));
    			$user->setEmail($request->request->get('email'));
    			$user->setUsername($request->request->get('username'));
    			$user->setPassword($request->request->get('password'));
    			
    			$em->persist($user);
    			$em->flush();
    			return $this->redirect($this->generateUrl('_user_success'));
    		}catch(Exception $e)
    		{
    			return $this->redirect($this->generateUrl('_user_fail'));
    		}
    		
    	}
    	return $this->render('AcmeDondeRecicloBundle:Default:user.html.twig', array());
    }
    
    public function pointAction(Request $request)
    {
    	
    		$em = $this->getDoctrine()->getManager();
    		
    		if ($request->getMethod() == 'POST') {
    			try {
    				$em->beginTransaction();
    				$user = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:User')->find(5);//quemado!!!
    				 
    				$point =new Point();
    				 
    				$point->setPlaceName($request->request->get('materialType'));
    				$point->setContactEmail($request->request->get('contactEmail'));
    				$point->setContactPhone($request->request->get('ContactPhone'));
    				$point->setAddress($request->request->get('Address'));
    				$point->setWebsite($request->request->get('website'));
    				$point->setCountryGeonameId($request->request->get('countryGeonameId'));
    				$point->setStateGeonameId($request->request->get('stateGeonameId'));
    				$point->setLat($request->request->get('lat'));
    				$point->setLng($request->request->get('lng'));
    				$point->setUser($user);
    				$em->persist($point);
    				$em->flush();
    				 
    				foreach ($request->request->get('materialType') as $mt)
    				{
    					$materialPoint = new MaterialPoint();
    					$materialPoint->setPoint($point);
    					$materialType = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:MaterialType')->find($mt);
    					$materialPoint->setMaterialType($materialType);
    					$em->persist($materialPoint);
    					$em->flush();
    				}
    				$em->commit();
    				return $this->redirect($this->generateUrl('_point_success'));
    			}catch(Exception $e)
    			{
    				$em->rollback();
    				return $this->redirect($this->generateUrl('_point_fail'));
    			}
    		}else{
    			$materialType = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:MaterialType')->findAll();
    			return $this->render('AcmeDondeRecicloBundle:Default:addPoint.html.twig', array('materialType' => $materialType));
    		}
    	
    
    	
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
