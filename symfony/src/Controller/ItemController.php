<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Order;
use App\Form\ItemType;
use App\Repository\ItemRepository;
use App\Service\ItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    #[Route('/order/{id}/item/new', name: 'app_item_new', methods: ['GET', 'POST'])]
    public function new(Order $order, Request $request, ItemRepository $itemRepository, ItemService $itemService): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $itemService->generateAmount($item);
            $item->setCommande($order);
            $itemRepository->save($item, true);

            return $this->redirectToRoute('app_order_show', [ 'id' => $order->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('item/new.html.twig', [
            'order' => $order,
            'item' => $item,
            'form' => $form,
        ]);
    }

    #[Route('/item/{id}', name: 'app_item_show', methods: ['GET'])]
    public function show(Item $item) {
        return $this->render('item/show.html.twig', [
            'item' => $item,
        ]);
    }

    #[Route('/item/{id}/delete', name: 'app_item_delete', methods: ['POST'])]
    public function delete(Request $request, Item $item, ItemRepository $itemRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$item->getId(), $request->request->get('_token'))) {
            $itemRepository->remove($item, true);
        }

        return $this->redirectToRoute('app_order_show', ['id' => $item->getCommande()->getId()], Response::HTTP_SEE_OTHER);
    }
}
