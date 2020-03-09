<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer):Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($contact);

            $entityManager->flush();

            $nom = $contact->getNom();
            $prenom = $contact->getPrenom();
            $email = $contact->getEmail();
            $Message = $contact->getMessage();
            $bien = $contact->getBien();

            $message = (new Swift_Message())
                ->setFrom([$email => $nom." ".$prenom])
                ->setTo(['tournon.kilian@gmail.com', 'tournon.kilian@gmail.com'])
                ->setCharset('UTF-8')
                ->setBody("<html lang=><head><meta charset='UTF-8'><title></title></head><body>"."Interessé par : ".$bien."</br>".$Message."</body></html>");
//                ->attach(Swift_Attachment::fromPath('my-document.pdf'))
// Send the message
            $message->setContentType("text/html");
            $mailer->send($message);

          return $this->redirectToRoute('home');

        }



        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }
}
