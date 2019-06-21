<?php

declare(strict_types=1);

namespace Netgen\TagsBundle\Core\Search\Solr\Query\Common\CriterionVisitor\Tags;

use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion\Operator;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;
use EzSystems\EzPlatformSolrSearchEngine\Query\CriterionVisitor;
use Netgen\TagsBundle\API\Repository\Values\Content\Query\Criterion\TagKeyword as APITagKeyword;
use Netgen\TagsBundle\Core\Search\Solr\Query\Common\CriterionVisitor\Tags;

final class TagKeyword extends Tags
{
    public function canVisit(Criterion $criterion): bool
    {
        return $criterion instanceof APITagKeyword;
    }

    public function visit(Criterion $criterion, ?CriterionVisitor $subVisitor = null): string
    {
        $criterion->value = (array) $criterion->value;
        $searchFields = $this->getSearchFields($criterion);
        $isLikeOperator = $criterion->operator === Operator::LIKE;

        if (count($searchFields) === 0) {
            throw new InvalidArgumentException(
                '$criterion->target',
                "No searchable fields found for the given criterion target '{$criterion->target}'."
            );
        }

        $queries = [];
        foreach ($searchFields as $name => $fieldType) {
            foreach ($criterion->value as $value) {
                $preparedValue = $this->escapeQuote(
                    $this->toString(
                        $this->mapSearchFieldValue($value, $fieldType)
                    ),
                    true
                );

                if ($isLikeOperator) {
                    $queries[] = '{!prefix f=' . $name . ' v="' . $preparedValue . '"}';
                } else {
                    $queries[] = $name . ':"' . $preparedValue . '"';
                }
            }
        }

        return '(' . implode(' OR ', $queries) . ')';
    }
}
