<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use League\Csv\Writer;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRepository;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectRepository;
use AppBundle\Entity\Attendance;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;
use AppBundle\Utils\ChoiceList\GenderChoiceLoader;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;
use AppBundle\Utils\ChoiceList\CategoryChoiceLoader;

/**
 * ExportController
 * 
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/export")
 */
class ExportController extends AbstractAppController
{
    const EXPORT_TYPE_MEMBER_ALL        = 1;
    const EXPORT_TYPE_MEMBER_STUDENT    = 2;
    const EXPORT_TYPE_MEMBER_NO_STUDENT = 3;
    
    const EXPORT_TYPE_PROJECT = 11;
    
    /**
     * @Route("", name="member_export_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('export/index.html.twig');
    }
    
    /**
     * @Route("/member/all", name="member_export_member_all")
     */
    public function memberAllAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
                ->findAllSortedByOrganization();

        return $this->createMemberList($users, ExportController::EXPORT_TYPE_MEMBER_ALL);
    }
    
    /**
     * @Route("/member/student", name="member_export_member_student")
     */
    public function memberStudentAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
                ->findByOccupationSortedByOrganization(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);

        return $this->createMemberList($users, ExportController::EXPORT_TYPE_MEMBER_STUDENT);
    }
    
    /**
     * @Route("/member/nostudent", name="member_export_member_nostudent")
     */
    public function memberNoStudentAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
                ->findExcluededByOccupationSortedByOrganization(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);

        return $this->createMemberList($users, ExportController::EXPORT_TYPE_MEMBER_NO_STUDENT);
    }
    
    protected function createMemberList($users, $type)
    {        
        $response = new Response($this->createMemberCSV($users));
        $d = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $this->getFilename($type)
        );
        $response->headers->set('Content-Disposition', $d);
        
        return $response;
    }
    
    protected function createMemberCSV($users)
    {
        $accountChoices      = (new AccountChoiceLoader())->getChoicesFliped();
        $genderChoices      = (new GenderChoiceLoader())->getChoicesFliped();
        $occupationChoices  = (new OccupationChoiceLoader())->getChoicesFliped();
        
        $writer = Writer::createFromString('','');
        $writer->setNewline("\r\n");
        
        $writer->insertOne(['#', 'Firstname', 'Lastname', 'Organization', 'Occupation', 'Type', 'Gender', 'Email', 'Allergies', 'Project', 'Attendances']);
        
        foreach ($users as $i => $user) {
            
            $projectNames = array();
            foreach ($user->getProjects() as $project) {
                $projectNames[] = $project->getName();
            }
            $projectNames = implode(", ", $projectNames);
            
            $attendanceNames = array();
            foreach ($user->getAttendances() as $attendance) {
                $attendanceNames[] = $attendance->getActivity()->getName();
            }
            $attendanceNames = implode(", ", $attendanceNames);
            
            $writer->insertOne([
                $i + 1,
                $user->getFirstname(),
                $user->getLastname(),
                $user->getOrganization()->getShortname(),
                $occupationChoices[$user->getOccupation()],
                $accountChoices[$user->getType()],
                $genderChoices[$user->getGender()],
                $user->getEmail(),
                $user->getAllergies(),
                $projectNames,
                $attendanceNames,
            ]);
        }
        
        return (string)$writer;
    }
    
    protected function getFilename($type)
    {
        $filename = null;
        switch ($type)
        {
            case ExportController::EXPORT_TYPE_MEMBER_ALL:
                $filename = 'member_all_';
                break;
            case ExportController::EXPORT_TYPE_MEMBER_STUDENT:
                $filename = 'member_student_';
                break;
            case ExportController::EXPORT_TYPE_MEMBER_NO_STUDENT:
                $filename = 'member_no_student_';
                break;
            case self::EXPORT_TYPE_PROJECT:
                $filename = 'project_all_';
                break;
        }
        
        return $filename . date("Ymd-His", time()) . '.csv';
    }
    
    /**
     * @Route("/project/all", name="member_export_project_all")
     */
    public function projectAction()
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')
                ->findAllSortedByOrganization();

        return $this->createProjectList($projects, self::EXPORT_TYPE_PROJECT);
    }
    
    protected function createProjectList($projects, $type)
    {        
        $response = new Response($this->createProjectCSV($projects));
        $d = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $this->getFilename($type)
        );
        $response->headers->set('Content-Disposition', $d);
        
        return $response;
    }
    
    protected function createProjectCSV($projects)
    {
        $categoryChoices      = (new CategoryChoiceLoader())->getChoicesFliped();
        
        $writer = Writer::createFromString('','');
        $writer->setNewline("\r\n");
        
        $writer->insertOne(['#', 'School', 'Code', 'Title', 'Concept', 'Objective', 'Category', 'Students', 'Teachers']);
        
        foreach ($projects as $i => $project) {
            
            $students = array();
            $teachers = array();
            foreach ($project->getUsers() as $user) {
                if ($user->getOccupation() == OccupationChoiceLoader::OCCUPATION_STUDENT_ID) {
                    $students[] = $user->getFullName();
                } else {
                    $teachers[] = $user->getFullName();
                }
            }
            $students = implode(", ", $students);
            $teachers = implode(", ", $teachers);
            
            $writer->insertOne([
                $i + 1,
                $project->getOrganization()->getShortname(),
                $project->getTopic(),
                $project->getName(),
                $project->getConcept(),
                $project->getObjective(),
                $categoryChoices[$project->getCategory()],
                $students,
                $teachers,
            ]);
        }
        
        return (string)$writer;
    }
}
