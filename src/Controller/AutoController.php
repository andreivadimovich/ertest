<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Form\AutoType;
use App\Repository\AutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auto")
 */
class AutoController extends AbstractController
{
    /**
     * @Route("/main")
     */
    public function main() : Response
    {
        $autoList = $this->getDoctrine()
            ->getRepository(Auto::class)
            ->findAll();

        return $this->render('auto/main.html.twig', [
            'list' => $autoList,
            'model' => new Auto(),
        ]);
    }

    /**
     * @Route("/", name="auto_index", methods={"GET"})
     */
    public function index(): Response
    {
        $auto = $this->getDoctrine()
            ->getRepository(Auto::class);

        return $this->render('auto/index.html.twig', [
            'autos' => $auto->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="auto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $auto = new Auto();
        $form = $this->createForm(AutoType::class, $auto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auto);
            $entityManager->flush();

            return $this->redirectToRoute('auto_index');
        }

        return $this->render('auto/new.html.twig', [
            'auto' => $auto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="auto_show", methods={"GET"})
     */
    public function show(Auto $auto): Response
    {
        return $this->render('auto/show.html.twig', [
            'auto' => $auto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="auto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Auto $auto): Response
    {
        $form = $this->createForm(AutoType::class, $auto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auto_index', [
                'id' => $auto->getId(),
            ]);
        }

        return $this->render('auto/edit.html.twig', [
            'auto' => $auto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="auto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Auto $auto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($auto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('auto_index');
    }
}
