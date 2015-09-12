<?php
/**
 * Created by PhpStorm.
 * User: salif.guigma
 * Date: 8/13/15
 * Time: 9:37 AM
 */

namespace AppBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SpanishId extends Constraint
{

    public $message = 'The ID "%string%" is not valid.';
}