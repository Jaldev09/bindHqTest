<?php
namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 *
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function save(Company $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Company $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getCompanies()
    {
        $sql = "SELECT c.id, c.company_name, count(s.company_id) as sales, IFNULL(SUM(s.amount), 0) as amount FROM `company` as c left join sales as s on s.company_id = c.id GROUP BY c.company_name;";

        $em = $this->getEntityManager();

        $stmt = $em->getConnection()->prepare($sql);
        $result = $stmt->executeQuery()->fetchAllAssociative();
        
        if(!$result){
            return array('error' => true, 'message' => 'Data not found.');
        }

        return array('error' => false, 'message' => '', 'data' => $result);
    }

    public function getCompanyById($id)
    {
        $sql = "SELECT c.id, c.company_name, count(s.company_id) as sales, IFNULL(SUM(s.amount), 0) as amount FROM `company` as c left join sales as s on s.company_id = c.id WHERE c.id = :age GROUP BY c.company_name;";

        $em = $this->getEntityManager();

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->bindParam('age', $id);
        $result = $stmt->executeQuery()->fetch();

        if(!$result){
            return array('error' => true, 'message' => 'Data not found with the company id: ' . $id);
        }

        return array('error' => false, 'message' => '', 'data' => $result);
    }
}
