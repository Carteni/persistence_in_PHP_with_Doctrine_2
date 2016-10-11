<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\Transformer\GeoTransformer;
use AppBundle\Model\Geo\Coordinate;
use Ivory\GoogleMap\Map;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CoordinateType
 * @package AppBundle\Form\Type
 */
class CoordinateType extends AbstractType
{
    /**
     * @var Map $map
     */
    protected $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new GeoTransformer);

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
          function(FormEvent $event) use($builder) {

              /**
               * @var Coordinate $data
               */
              $data = $event->getData();

              if(null === $data->getLatitude()) {

                  $event->setData(new Coordinate(
                    38.91311850372953,
                    116.4002054820312
                  ));
              }

              // Qui possiamo modificare i dati se la form non
              // è stata inviata.
              $var = 1;
          });
    }

    public function buildView(
      FormView $view,
      FormInterface $form,
      array $options
    ) {
        /*$center = Coordinate::factory()
          ->setLatitude(39.91311850372953)
          ->setLongitude(116.4002054820312)
          ->toGMaps();*/

        // $form->getData() è 'location' definita nel Contrtoller.
        $lat = $form->getData()->getLatitude();
        $long = $form->getData()->getLongitude();
        $center = Coordinate::factory()
          ->setLatitude($lat)
          ->setLongitude($long)
          ->toGMaps();

        $this->map->setCenter($center);
        $this->map->setMapOption('zoom', 10);
        $view->vars['map'] = $this->map;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
          array(
            'compound' => false,
            'data_class' => 'AppBundle\Model\Geo\Coordinate',
            'data' => new Coordinate()
          )
        );
    }

    public function getBlockPrefix()
    {
        return "coordinate";
    }
}