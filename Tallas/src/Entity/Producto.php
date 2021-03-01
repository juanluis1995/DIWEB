<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tamanio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fotografia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $existencias;

    /**
     * @ORM\ManyToMany(targetEntity=Pedido::class, inversedBy="productos")
     */
    private $pedido;

    public function __construct()
    {
        $this->pedido = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getTamanio(): ?string
    {
        return $this->tamanio;
    }

    public function setTamanio(string $tamanio): self
    {
        $this->tamanio = $tamanio;

        return $this;
    }

    public function getFotografia(): ?string
    {
        return $this->fotografia;
    }

    public function setFotografia(string $fotografia): self
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getExistencias(): ?int
    {
        return $this->existencias;
    }

    public function setExistencias(int $existencias): self
    {
        $this->existencias = $existencias;

        return $this;
    }

    /**
     * @return Collection|Pedido[]
     */
    public function getPedido(): Collection
    {
        return $this->pedido;
    }

    public function addPedido(Pedido $pedido): self
    {
        if (!$this->pedido->contains($pedido)) {
            $this->pedido[] = $pedido;
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        $this->pedido->removeElement($pedido);

        return $this;
    }
}
