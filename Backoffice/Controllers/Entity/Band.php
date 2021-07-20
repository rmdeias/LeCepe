<?php
namespace Controllers\Entity;

class Band
{
    /**
     * type="integer"
     */
    private $id;

    /**
     type="string", length=255
     */
    private $name;

    /**
     type="string", length=255
     */
    private $image;

    /**
     type="string", length=255
     */
    private $description;

    /**
     type="string", length=255
     */
    private $linkFb;

    /**
     type="string", length=255
     */
    private $linkInsta;

    /**
     type="string", length=255
     */
    private $linkYoutube;

    /**
     type="string", length=255
     */
    private $iframeBandcamp;

    /**
     type="string", length=255
     */
    private $iframeYoutube;

    /**
     type="string", length=255
     */
    private $slug;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLinkFb(): ?string
    {
        return $this->linkFb;
    }

    public function setLinkFb(string $linkFb): self
    {
        $this->linkFb = $linkFb;

        return $this;
    }

    public function getLinkInsta(): ?string
    {
        return $this->linkInsta;
    }

    public function setLinkInsta(string $linkInsta): self
    {
        $this->linkInsta = $linkInsta;

        return $this;
    }

    public function getLinkYoutube(): ?string
    {
        return $this->linkYoutube;
    }

    public function setLinkYoutube(string $linkYoutube): self
    {
        $this->linkYoutube = $linkYoutube;

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

    public function getIframeYoutube(): ?string
    {
        return $this->iframeYoutube;
    }

    public function setIframeYoutube(string $iframeYoutube): self
    {
        $this->iframeYoutube = $iframeYoutube;

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
}
