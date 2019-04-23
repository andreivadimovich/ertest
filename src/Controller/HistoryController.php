<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\HistoryType;
use App\Entity\Auto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HistoryRepository;
use Symfony\Component\Form\FormError;

use App\Form\HistoryDatesType;

/**
 * @Route("/history")
 */
class HistoryController extends AbstractController
{
    /**
     * @Route("/", name="history_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        // select filters
        $filters = [
            'carId' => $request->query->get('car'),
            'dateFrom' => $request->query->get('date-from'),
            'dateTo' => $request->query->get('date-to')
        ];

        $histories = $this->getDoctrine()
            ->getRepository(History::class);

        // #TODO optimize_in_future
        if ($filters['carId']) {
            $histories = $histories
                ->findBy(['auto' => (int)$filters['carId']], ['gave' => 'ASC']);

            $auto = $this->getDoctrine()
                ->getRepository(Auto::class)
                ->findOneBy(['id' => (int)$filters['carId']]);

            $averageDates = $this->getDoctrine()
                ->getRepository(History::class)
                ->averageDate((int)$filters['carId']);
        }

        if ($filters['dateFrom'] && $filters['dateTo']) {
            $histories = $this->getDoctrine()
                ->getRepository(History::class)
                ->dateBeetwen((int)$filters['carId'], $filters['dateFrom'], $filters['dateTo']);

        } elseif (!$filters['carId']) {
            $histories = $histories->findBy(array(),['gave' => 'ASC']);

        }

        $history = new History();
        $form = $this->createForm(HistoryDatesType::class, $history);

        return $this->render('history/index.html.twig', [
            'histories' => $histories,
            'model' => new Auto(),
            'exist_auto' => isset($auto) ? $auto : false,
            'average' => isset($averageDates) ? $averageDates : false,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="history_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $history = new History();

        $form = $this->createForm(HistoryType::class, $history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($history);
            $entityManager->flush();

            // update auto state
            $autoId = $form->get('auto')->getData();
            $em = $this->getDoctrine()->getManager();
            $auto = $em->getRepository(Auto::class);
            $auto->updateState($autoId, Auto::STATE_RENT);

            return $this->redirectToRoute('history_index');
        }

        return $this->render('history/new.html.twig', [
            'history' => $history,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="history_show", methods={"GET"})
     */
    public function show(History $history): Response
    {
        return $this->render('history/show.html.twig', [
            'history' => $history,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="history_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, History $history): Response
    {
        $form = $this->createForm(HistoryType::class, $history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autoId = $form->get('auto')->getData();
            $em = $this->getDoctrine()->getManager();
            $auto = $em->getRepository(Auto::class);

            $gaveDate = $form->get('gave')->getData();

            if (!empty($gaveDate) && get_class($gaveDate) == 'DateTime') {
                $gaveDate = $gaveDate->format('Y-m-d H:i:s');
                $tookDate = $form->get('took')->getData();
                $tookDate = $tookDate->format('Y-m-d H:i:s');

                if ($tookDate > $gaveDate) {
                    $form->get('took')
                        ->addError(new FormError('The took date can not be earlier than the gave date'));

                    return $this->render('history/edit.html.twig', [
                        'history' => $history,
                        'form' => $form->createView(),
                    ]);
                }

                $auto->updateState($autoId, Auto::STATE_FREE);
            } else {
                $auto->updateState($autoId, Auto::STATE_RENT);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('history_index', [
                'id' => $history->getId(),
            ]);
        }

        return $this->render('history/edit.html.twig', [
            'history' => $history,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="history_delete", methods={"DELETE"})
     */
    public function delete(Request $request, History $history): Response
    {
        if ($this->isCsrfTokenValid('delete'.$history->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($history);
            $entityManager->flush();
        }

        return $this->redirectToRoute('history_index');
    }
}
