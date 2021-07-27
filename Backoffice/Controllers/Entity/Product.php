<?php
namespace Controllers\Entity;


class Product
{
    /**
     type="integer"
     */
    private $id;

    /**
     type="string", length=255
     */
    private $title;

    /**
     type="integer"
     */
    private $idBand;

    /**
     type="string", length=255
     */
    private $date;

    /**
     type="string", length=255
     */
    private $type;

    /**
     type="string", length=255
     */
    private $price;

    /**
     type="string", length=255
     */
    private $iframeBandcamp;

    /**
     type="string", length=255
     */
    private $linkBandcamp;

    /**
     type="string", length=255
     */
    private $slug;

    /**
     type="string", length=255
     */
    private $dispo;

    /**
     type="string", length=255
     */
    private $description;

    /**
     type="string", length=255
     */
    private $image;

    /**
     type="string", length=255
     */
    private $imageAlt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIdBand(): ?int
    {
        return $this->idBand;
    }

    public function setIdBand(int $idBand): self
    {
        $this->idBand = $idBand;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getLinkBandcamp(): ?string
    {
        return $this->linkBandcamp;
    }

    public function setLinkBandcamp(string $linkBandcamp): self
    {
        $this->linkBandcamp = $linkBandcamp;

        return $this;
    }

    public function getIframeBandcamp(): ?string
    {
        return $this->iframeBandcamp;
    }

    public function setIframeBandcamp(string $iframeBandcamp): self
    {
        $this->iframeBandcamp = $iframeBandcamp;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDispo(): ?string
    {
        return $this->dispo;
    }

    public function setDispo(string $dispo): self
    {
        $this->dispo = $dispo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageAlt(): ?string
    {
        return $this->imageAlt;
    }

    public function setImageAlt(string $imageAlt): self
    {
        $this->imageAlt = $imageAlt;

        return $this;
    }
}
