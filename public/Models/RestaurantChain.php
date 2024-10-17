<?php
namespace Models;

use Interfaces\FileConvertible;
use Models\Company;

class RestaurantChain extends Company implements FileConvertible
{
    public int $chainId;
    public array $restaurantLocations; // RestaurantLocation[]
    public string $cuisineType;
    public int $numberOfLocations;
    public string $parentCompany;

    public function __construct(
        int $chainId,
        array $restaurantLocations,
        string $cuisineType,
        int $numberOfLocations,
        string $parentCompany,
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
        parent::__construct($name, $foundingYear, $description, $website, $phone, $industry, $ceo, $isPubliclyTraded, $country, $founder, $totalEmployees);
        $this->chainId = $chainId;
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    // FileConvertible インターフェースのメソッドをオーバーライド
    public function toString(): string
    {
        $parentString = parent::toString();
        return $parentString . sprintf(
            "Chain ID: %d Restaurant Locations: %s Cuisine Type: %s Number of Locations: %d Parent Company: %s",
            $this->chainId,
            $this->restaurantLocations,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany
        );
    }
    public function toHTML(): string
    {
        $parentHTML = parent::toHTML();
        $locationsHTML = array_map(function($location) {
            return $location->toHTML();
        }, $this->restaurantLocations);

        return str_replace('</div>', '', $parentHTML) . sprintf("
            <p>Chain ID: %d</p>
            <p>Cuisine Type: %s</p>
            <p>Number of Locations: %d</p>
            <p>Parent Company: %s</p>
            <h3>Restaurant Locations:</h3>
            %s
        </div>",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany,
            implode('', $locationsHTML)
        );
    }

    public function toMarkDown(): string
    {
        $parentMarkdown = parent::toMarkdown();
        $locationsMarkdown = array_map(function($location) {
            return $location->toMarkDown();
        }, $this->restaurantLocations);

        return $parentMarkdown . sprintf("
                ### Restaurant Chain Details
                - Chain ID: %d
                - Cuisine Type: %s
                - Number of Locations: %d
                - Parent Company: %s

                ### Restaurant Locations:
                %s",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany,
            implode("\n", $locationsMarkdown)
        );
    }

    public function toArray(): array
    {
        $parentArray = parent::toArray();
        $locationsArray = array_map(function($location) {
            return $location->toArray();
        }, $this->restaurantLocations);

        return array_merge($parentArray, [
            'chainId' => $this->chainId,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'parentCompany' => $this->parentCompany,
            'restaurantLocations' => $locationsArray
        ]);
    }

    // チェーンに新しいレストランの場所を追加するメソッド
    public function addRestaurantLocation(RestaurantLocation $location): void {
        $this->restaurantLocations[] = $location;
        $this->numberOfLocations = count($this->restaurantLocations);
    }

    // チェーン内のすべてのレストランの場所を表示するメソッド
    public function displayAllLocations(): string {
        $output = "All Restaurant Locations for {$this->name}:\n";
        foreach ($this->restaurantLocations as $index => $location) {
            $output .= ($index + 1) . ". " . $location->toString() . "\n";
        }
        return $output;
    }

    // チェーンに関する情報を表示するメソッド（Company から継承）
    public function displayChainInfo(): string {
        $parentInfo = parent::toString();
        $chainInfo = sprintf(
            "Chain ID: %d\nCuisine Type: %s\nNumber of Locations: %d\nParent Company: %s",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany
        );
        return $parentInfo . "\n" . $chainInfo;
    }
}