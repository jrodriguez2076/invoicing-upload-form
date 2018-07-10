<?php

declare(strict_types=1);

namespace App\Service;

class SellerSignUpService
{
    public function getContributorTypesChoices(string $country): array
    {
        switch ($country) {
            case 'mx':
                return [
                    '601-General de ley personas morales' => '601-General de ley personas morales',
                    '603-Personas morales con fines no lucrativos' => '603-Personas morales con fines no lucrativos',
                    '605-Sueldos y salarios e ingresos asimilados a salarios' => '605-Sueldos y salarios e ingresos asimilados a salarios',
                    '606-Arrendamiento' => '606-Arrendamiento',
                    '608-Demás ingresos' => '608-Demás ingresos',
                    '609-Consolidación' => '609-Consolidación',
                    '610-Residentes en el extranjero sin establecimiento permanente en México' => '610-Residentes en el extranjero sin establecimiento permanente en México',
                    '611-Ingresos por dividendos (socios y accionistas)' => '611-Ingresos por dividendos (socios y accionistas)',
                    '612-Personas físicas con actividades empresariales y profesionales' => '612-Personas físicas con actividades empresariales y profesionales',
                    '614-Ingresos por intereses' => '614-Ingresos por intereses',
                    '616-Sin obligaciones fiscales' => '616-Sin obligaciones fiscales',
                    '620-Sociedades cooperativas de producción que optan por diferir sus ingresos' => '620-Sociedades cooperativas de producción que optan por diferir sus ingresos',
                    '621-Incorporación fiscal' => '621-Incorporación fiscal',
                    '622-Actividades agrícolas, ganaderas, silvícolas y pesqueras' => '622-Actividades agrícolas, ganaderas, silvícolas y pesqueras',
                    '623-Opcional para grupos de sociedades' => '623-Opcional para grupos de sociedades',
                    '624-Coordinados' => '624-Coordinados',
                    '628-Hidrocarburos' => '628-Hidrocarburos',
                    '607-Régimen de enajenación o adquisición de bienes' => '607-Régimen de enajenación o adquisición de bienes',
                    '629-De los regímenes fiscales preferentes y de las empresas multinacionales' => '629-De los regímenes fiscales preferentes y de las empresas multinacionales',
                    '630-Enajenación de acciones en bolsa de valores' => '630-Enajenación de acciones en bolsa de valores',
                    '615-Régimen de los ingresos por obtención de premios' => '615-Régimen de los ingresos por obtención de premios',
                    'International seller' => 'International seller',
                ];
                break;
            case 'co':
                return [
                    'Régimen Simplificado' => 'Régimen Simplificado',
                    'Régimen Común' => 'Régimen Común',
                    'Gran Contribuyente' => 'Gran Contribuyente',
                ];
                break;
            case 'cl':
                return [
                    'Limitada' => 'Limitada',
                    'EIRL' => 'EIRL',
                    'SpA' => 'SpA',
                    'Persona Natural' => 'Persona Natural',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                ];
                break;
            case 'ar':
                return [
                    'Sociedad de Responsabilidad limitada ' => 'Sociedad de Responsabilidad limitada ',
                    'Monotributista' => 'Monotributista',
                    'Responsable Inscrito' => 'Responsable Inscrito',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                ];
                break;
            case 'ec':
                return [
                    'Persona jurídica' => 'Persona jurídica',
                    'Persona natural con negocio' => 'Persona natural con negocio',
                ];
                break;
            case 'pe':
                return [
                    'Sociedad Anónima Cerrada' => 'Sociedad Anónima Cerrada',
                    'S.R.L.' => 'PE-S.R.L.',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                    'Persona natural con negocio' => 'Persona natural con negocio',
                    'Empresa Individual de Responsabilidad Limitada' => 'Empresa Individual de Responsabilidad Limitada',
                ];
                break;
            case 'pa':
                return [
                    'Sociedad Colectiva de Responsabilidad Limitada' => 'Sociedad Colectiva de Responsabilidad Limitada',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                    'Empresa Individual de Responsabilidad Limitada' => 'Empresa Individual de Responsabilidad Limitada',
                ];
                break;
            default:
                return [];
        }
    }

    public function getMainCategoriesChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Electrodomésticos' => 'Electrodomésticos',
                    'Libros' => 'Libros',
                    'Celulares y Tablets' => 'Celulares y Tablets',
                    'Computación' => 'Computación',
                    'Moda' => 'Moda',
                    'Belleza y cuidado personal' => 'Belleza y cuidado personal',
                    'Hogar,Niños y bebés' => 'Hogar,Niños y bebés',
                    'Fotografía' => 'Fotografía',
                    'Deportes' => 'Deportes',
                    'TV/Audio/Video' => 'TV/Audio/Video',
                    'Videojuegos' => 'Videojuegos',
                    'Otro' => 'Otro',
                ];
                break;
        }
    }

    public function getSecondaryCategoriesChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Electrodomésticos' => 'Electrodomésticos',
                    'Libros' => 'Libros',
                    'Celulares y Tablets' => 'Celulares y Tablets',
                    'Computación' => 'Computación',
                    'Moda' => 'Moda',
                    'Belleza y cuidado personal' => 'Belleza y cuidado personal',
                    'Hogar,Niños y bebés' => 'Hogar,Niños y bebés',
                    'Fotografía' => 'Fotografía',
                    'Deportes' => 'Deportes',
                    'TV/Audio/Video' => 'TV/Audio/Video',
                    'Videojuegos' => 'Videojuegos',
                    'Otro' => 'Otro',
                ];
                break;
        }
    }

    public function getPotentialCatalogChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    '1-29' => '1-29',
                    '30-60' => '30-60',
                    '61-150' => '61-150',
                    '151-500' => '151-500',
                    '501-1000' => '501-1000',
                    '1001+' => '1001+',
                ];
                break;
        }
    }

    public function getOtherStoresRatingChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    '5/5' => '5/5',
                    '4/5' => '4/5',
                    '3/5' => '3/5',
                    '2/5' => '2/5',
                    '1/5' => '1/5',
                ];
                break;
        }
    }

    public function getOtherStoresListChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Amazon' => 'Amazon',
                    'Mercado Libre' => 'Mercado Libre',
                    'Walmart' => 'Walmart',
                    'Otra' => 'Otra',
                    'No vendo' => 'No vendo',
                ];
                break;
        }
    }

    public function getMarketingInvestChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    '0' => '0',
                    '1-100' => '1-100',
                    '101-500' => '101-500',
                    '501-1000' => '501-1000',
                    '1001+' => '1001+',
                ];
                break;
        }
    }

    public function getIntegrationFlagChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Sí' => 'Sí',
                    'No' => 'No',
                ];
                break;
        }
    }

    public function getWarehouseModeChoices(string $country): array
    {
        switch ($country) {
            case 'ar':
                return [
                    'Pickup' => 'P',
                    'Dropoff' => 'D',
                ];
                break;
            default:
                return [];
        }
    }

    public function getWarehouseCities(string $country): array
    {
        switch ($country) {
            case 'pe':
                return [
                    'Lima' => 'Lima|Lima|Lima',
                    'Callao' => 'Callao|Callao|Callao',
                ];
                break;
            default:
                return [];
        }
    }
}
