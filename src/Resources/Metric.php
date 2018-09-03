<?php

namespace Baorv\Klaviyo\Resources;

/**
 * The Metrics API is used for historical event data in Klaviyo
 *
 * @see https://www.klaviyo.com/docs/api/metrics
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Metric extends BaseSecretResource
{

    /**
     * Returns a list of all the metrics in Klaviyo.
     *
     * @param array $params
     * @return mixed
     */
    public function all($params = [])
    {
        return $this->client->get('metrics', $params);
    }

    /**
     * Returns a batched timeline of all events in your Klaviyo account.
     *
     * @param null $metricId
     * @param array $params
     * @return mixed
     */
    public function timeline($metricId = null, $params = [])
    {
        if (is_null($metricId)) {
            return $this->client->get('metrics/timeline', $params);
        }
        return $this->client->get("metric/{$metricId}/timeline", $params);
    }

    /**
     * Export event data from Klaviyo, optionally filtering and segmented on available event properties.
     *
     * @param int $metricId
     * @param array $params
     * @return mixed
     */
    public function export($metricId, $params = [])
    {
        return $this->client->get("metric/{$metricId}/export", $params);
    }
}