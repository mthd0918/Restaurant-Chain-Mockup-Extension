<?php
namespace Models;

use Interfaces\FileConvertible;

class Company implements FileConvertible
{
    public string $name;
    public int $foundingYear;
    public string $description;
    public string $website;
    public string $phone;
    public string $industry;
    public string $ceo;
    public bool $isPubliclyTraded;
    public string $country;
    public string $founder;
    public int $totalEmployees;

    public function __construct(
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded,
        string $country,
        string $founder,
        int $totalEmployees
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }


    public function toString(): string
    {
        return sprintf(
            "Company: %s\nFounded: %d\nDescription: %s\nWebsite: %s\nPhone: %s\nIndustry: %s\nCEO: %s\nPublicly Traded: %s\nCountry: %s\nFounder: %s\nTotal Employees: %d",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'Yes' : 'No',
            $this->country,
            $this->founder,
            $this->totalEmployees
        );
    }

    public function toHTML(): string
    {
        return sprintf(
            "<div class='company-card'>
                <p>%s</p>
                <p>Founded: %d</p>
                <p>Description: %s</p>
                <p>Website: <a href='%s'>%s</a></p>
                <p>Phone: %s</p>
                <p>Industry: %s</p>
                <p>CEO: %s</p>
                <p>Publicly Traded: %s</p>
                <p>Country: %s</p>
                <p>Founder: %s</p>
                <p>Total Employees: %d</p>
            </div>",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'Yes' : 'No',
            $this->country,
            $this->founder,
            $this->totalEmployees
        );
    }

    public function toMarkDown(): string
    {
        return sprintf(
            "# %s\n\n" .
            "- Founded: %d\n" .
            "- Description: %s\n" .
            "- Website: [%s](%s)\n" .
            "- Phone: %s\n" .
            "- Industry: %s\n" .
            "- CEO: %s\n" .
            "- Publicly Traded: %s\n" .
            "- Country: %s\n" .
            "- Founder: %s\n" .
            "- Total Employees: %d\n",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'Yes' : 'No',
            $this->country,
            $this->founder,
            $this->totalEmployees
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded,
            'country' => $this->country,
            'founder' => $this->founder,
            'totalEmployees' => $this->totalEmployees
        ];
    }
}