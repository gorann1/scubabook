<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;


#[ORM\Entity(repositoryClass: CityRepository::class)]
#[ApiResource (order: ['name' => 'ASC'])]
class City
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

    #[ORM\ManyToOne(inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $region = null;

    /**
     * @var string|null
     *
     * @Gedmo\Slug(fields={"name", "iso3"})
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

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: Center::class)]
    private Collection $centers;

    public function __construct()
    {
        $this->centers = new ArrayCollection();
    }

    public function __toString(): string {
        return (string) $this->name;
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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, Center>
     */
    public function getCenters(): Collection
    {
        return $this->centers;
    }

    public function addCenter(Center $center): self
    {
        if (!$this->centers->contains($center)) {
            $this->centers->add($center);
            $center->setCity($this);
        }

        return $this;
    }

    public function removeCenter(Center $center): self
    {
        if ($this->centers->removeElement($center)) {
            // set the owning side to null (unless already changed)
            if ($center->getCity() === $this) {
                $center->setCity(null);
            }
        }

        return $this;
    }
}
