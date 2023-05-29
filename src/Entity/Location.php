<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\Entity(repositoryClass: LocationRepository::class)]
#[ApiResource (order: ['name' => 'ASC'])]
class Location
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 10, nullable: true)]
    private ?string $ltd = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 10, nullable: true)]
    private ?string $lng = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Visibility $visibility = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Depth $depth = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Current $current = null;

    #[ORM\ManyToMany(targetEntity: City::class, inversedBy: 'locations')]
    private Collection $city;

    #[ORM\ManyToMany(targetEntity: Center::class, inversedBy: 'locations')]
    private Collection $center;

    /**
     * @var string|null
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    #[ORM\Column(length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    private $slug;

    /**
     * @var \DateTime $created
     *
     * Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function __construct()
    {
        $this->city = new ArrayCollection();
        $this->center = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLtd(): ?string
    {
        return $this->ltd;
    }

    public function setLtd(?string $ltd): self
    {
        $this->ltd = $ltd;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getVisibility(): ?Visibility
    {
        return $this->visibility;
    }

    public function setVisibility(?Visibility $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getDepth(): ?Depth
    {
        return $this->depth;
    }

    public function setDepth(?Depth $depth): self
    {
        $this->depth = $depth;

        return $this;
    }

    public function getCurrent(): ?Current
    {
        return $this->current;
    }

    public function setCurrent(?Current $current): self
    {
        $this->current = $current;

        return $this;
    }

    /**
     * @return Collection<int, City>
     */
    public function getCity(): Collection
    {
        return $this->city;
    }

    public function addCity(City $city): self
    {
        if (!$this->city->contains($city)) {
            $this->city->add($city);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        $this->city->removeElement($city);

        return $this;
    }

    /**
     * @return Collection<int, Center>
     */
    public function getCenter(): Collection
    {
        return $this->center;
    }

    public function addCenter(Center $center): self
    {
        if (!$this->center->contains($center)) {
            $this->center->add($center);
        }

        return $this;
    }

    public function removeCenter(Center $center): self
    {
        $this->center->removeElement($center);

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
}
