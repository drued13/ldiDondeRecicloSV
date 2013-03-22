<?php

namespace Acme\Bundle\DondeRecicloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

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
    		$materialType = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:MaterialType')->findAll();
    		if ($request->getMethod() == 'POST') {
    			try {
    				$em->beginTransaction();
    				$user = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:User')->find(5);//quemado!!!
    				 
    				$point =new Point();
    				 
    				$point->setPlaceName($request->request->get('placeName'));
    				$point->setContactEmail($request->request->get('contactEmail'));
    				$point->setContactPhone($request->request->get('ContactPhone'));
    				$point->setAddress($request->request->get('Address'));
    				$point->setWebsite($request->request->get('website'));
    				$point->setCountryGeonameId($request->request->get('countryGeonameId'));
    				$point->setStateGeonameId($request->request->get('stateGeonameId'));
    				$point->setCityGeonameId($request->request->get('cityGeonameId'));
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
    				return $this->render('AcmeDondeRecicloBundle:Default:addPoint.html.twig', array('materialType' => $materialType,'status' => $e->getMessage()));
    			}
    		}else{
    			
    			return $this->render('AcmeDondeRecicloBundle:Default:addPoint.html.twig', array('materialType' => $materialType,'status' => 'index'));
    		}
    }
    
    public function mapAction()
    {
    	//$points = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:Point')->findAll();
    	
    	return $this->render('AcmeDondeRecicloBundle:Default:recycleMap.html.twig');
    }
    
    public function pointsAction()
    {
    	//$materialType = $request->query->get('materialType');
    	
    		$points = $this->getDoctrine()->getRepository('AcmeDondeRecicloBundle:Point')->findAll();
    		
    		$contents =array();
    		$content = array();
    		 
    		foreach($points as $point){
    				$data = array(
    					"placeName" => $point->getPlaceName(),
    					"contactEmail" => $point->getContactEmail(),
    					"contactPhone" => $point->getContactPhone(),
    					"address" => $point->getAddress(),
    					"website" => $point->getWebsite(),
    					"countryGeonameId" => $point->getCountryGeonameId(),
    					"stateGeonameId" => $point->getStateGeonameId(),
    					"cityGeonameId" => $point->getCityGeonameId(),
    					"lat" => $point->getLat(),
    					"lng" => $point->getLng(),
    					"materialPoints" => $point->getMaterialPoints()
    				);
    				$content[] = $data;
    		 
    		$contents["content"] = $content;
    	}
    	
    	$response = new Response(json_encode($contents));
    	return $response;
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
