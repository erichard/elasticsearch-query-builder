<?php declare(strict_types=1);

namespace Erichard\ElasticQueryBuilder\Features;

trait HasFuzziness
{
    protected ?string $fuzziness = null;

    public function setFuzziness(?string $fuzziness): self
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    public function buildFuzzinessTo(array &$array): self
    {
        if (null === $this->fuzziness) {
            return $this;
        }

        $array['fuzziness'] = $this->fuzziness;

        return $this;
    }

    public function getFuzziness(): ?string
    {
        return $this->fuzziness;
    }
}
