<?php

namespace Baorv\Klaviyo\Resources;

/**
 * The Profiles API is used for managing person records in Klaviyo
 *
 * @see https://www.klaviyo.com/docs/api/people
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Profile extends BaseSecretResource
{

    /**
     * Retrieve all the data attributes for a person, based on the Klaviyo Person ID.
     *
     * @param int $personId
     * @return mixed
     */
    public function get($personId)
    {
        return $this->client->get("person/{$personId}");
    }

    /**
     * Add or update one more more attributes for a Person, based on the Klaviyo Person ID. If a property already
     * exists, it will be updated. If a property is not set for that record, it will be created.
     *
     * @param int $personId
     * @param array $person
     * @return mixed
     */
    public function createOrUpdate($personId, $person)
    {
        return $this->client->put("person/{$personId}", $person);
    }

    /**
     * Add or update one more more attributes for a Person, based on the Klaviyo Person ID. If a property already
     * exists, it will be updated. If a property is not set for that record, it will be created.
     *
     * @param int $persionId
     * @param array $params
     * @return mixed
     */
    public function metricsTimeline($persionId, $params = [])
    {
        return $this->client->get("person/{$persionId}/metrics/timline", $params);
    }

    /**
     * Returns a batched timeline of all events for a person.
     *
     * @param int $persionId
     * @param int $metricId
     * @param array $params
     * @return mixed
     */
    public function metricTimeline($persionId, $metricId, $params = [])
    {
        return $this->client->get("person/{$persionId}/metric/{$metricId}/timline", $params);
    }
}