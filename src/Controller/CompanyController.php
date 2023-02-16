<?php
namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    #[Route('/company', name: 'app_companies')]
    public function index(CompanyRepository $CompanyRepository, Request $request)
    {
        $companies = $CompanyRepository->getCompanies();

        //API Response
        if($request->headers->get('content-type')) {
          return $this->json($companies);
        }

        //Web Response
        return $this->render('companies.html.twig', [
            'company' => $companies,
            'title' => 'Companies'
        ]);

        
    }

    #[Route('/company/{id}', name: 'app_company')]
    public function getCompanyById(CompanyRepository $CompanyRepository, $id, Request $request)
    {
        $company = $CompanyRepository->getCompanyById($id);
        
        //API Response
        if($request->headers->get('content-type')) {
            return $this->json($company);
        }
        
        //Web Response
        return $this->render('company.html.twig', [
            'company' => $company,
            'title' => 'Company'
        ]);
    }
}
