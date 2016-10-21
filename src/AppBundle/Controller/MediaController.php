<?php

namespace AppBundle\Controller;

use Sonata\MediaBundle\Controller\MediaController as SonataMediaController;
use Sonata\MediaBundle\Model\Media;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MediaController extends SonataMediaController
{
    public function indexAction()
    {
        /**
         * @var \Application\Sonata\MediaBundle\Entity\Media[] $medias
         */
        $medias = $this->get('sonata.media.manager.media')->findAll();

        return $this->render(
          ':media:index.html.twig',
          array(
            'medias' => $medias,
          )
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $format
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $format = 'reference')
    {
        $media = $this->getMedia($id);

        if (!$media) {
            throw new NotFoundHttpException(
              sprintf('unable to find the media with the id : %s', $id)
            );
        }

        if (!$this->get('sonata.media.pool')
          ->getDownloadSecurity($media)
          ->isGranted($media, $this->get('request_stack')->getCurrentRequest())
        ) {
            throw new AccessDeniedException();
        }

        return $this->render(
          'SonataMediaBundle:Media:view.html.twig',
          array(
            'media' => $media,
            'formats' => $this->get('sonata.media.pool')
              ->getFormatNamesByContext($media->getContext()),
            'format' => $format,
          )
        );
    }

    public function hasGalleryUnlinkAction($id, $postId)
    {
        $media = $this->get('doctrine')->getRepository(
          'ApplicationSonataMediaBundle:GalleryHasMedia'
        )
          ->find($id);

        if ($media) {
            $em = $this->get('doctrine')->getManager();
            $em->remove($media);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->add(
          'post.success',
          sprintf('Image gallery %s unlinked', $media->getMedia()->getName())
        );

        return new RedirectResponse(
          $this->get('router')->generate('post.show', ['id' => $postId])
        );
    }

}