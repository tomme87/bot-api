<?php


namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController
 * @package App\Controller
 *
 * @Route("/test")
 */
class TestController {

  /**
   * @Route("/ok")
   *
   * @param DocumentManager $manager
   * @return JsonResponse
   */
  public function testing(DocumentManager $manager) {
    $user = new User();
    $user->setUsername('lmao2.0');

    $manager->persist($user);
    $manager->flush();

    return JsonResponse::create(['user' => $user->getId()]);
  }

  /**
   * @Route("/get")
   *
   * @param DocumentManager $manager
   * @return JsonResponse
   */
  public function testing2(DocumentManager $manager) {
    $user = $manager->getRepository(User::class)->find('c8f1943bada334f5a33a3469c9ab2e3c');

    return JsonResponse::create(['user' => $user->getUsername()]);
  }

}
