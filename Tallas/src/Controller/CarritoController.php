<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController {

    /**
     * @Route("/ver_carrito", name="ver_carrito")
     */

    public function mostrar(ProductoRepository $productoRepository) : Response
    {
        return $this->render('carrito/ver_carrito.html.twig', [
            'titulo' => 'Tallas de Madera',
            'productos' => $productoRepository->findAll()
        ]);
    }

    /**
     * @Route("/añadir/{id_producto}", name="añadir_carrito", methods={"GET"})
     */

    public function añadir(Producto $producto) : Response
    {   

        $producto = new Product();

        if ($producto->getId()) {
            return $this->redirectToRoute('index');
        }

        return $this->render('carrito/ver_carrito.html.twig', [
            'titulo' => 'Tallas de Madera',
            'producto' => $producto
        ]);
    }

    /**
     * @Route("/eliminar/{id_producto}", name="añadir", methods={"GET"})
     */

    public function eliminar(ProductoRepository $productoRepository) : Response
    {
        return $this->render('carrito/ver_carrito.html.twig', [
            'titulo' => 'Tallas de Madera',
            'productos' => $productoRepository->findAll()
        ]);
    }
}