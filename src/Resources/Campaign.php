<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Exceptions\ConfigurationException;

/**
 * The Campaigns API is used for creating and sending campaigns in Klaviyo
 *
 * @see https://www.klaviyo.com/docs/api/campaigns
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Campaign extends BaseSecretResource
{

    /**
     * Returns a list of all the campaigns you've created. The campaigns are returned in reverse sorted order by the
     * time they were created.
     *
     * @param array $options
     * @return mixed
     */
    public function all($options = [])
    {
        return $this->client->get('campaigns', $options);
    }

    /**
     * Creates a new campaign. The created campaign is a draft and is not automatically sent.
     *
     * @param array $campaign
     * @throws ConfigurationException
     * @return mixed
     */
    public function create($campaign)
    {
        if (
            (!array_key_exists('list_id', $campaign) || empty($campaign['list_id']))
            && (!array_key_exists('template_id', $campaign) || empty($campaign['template_id']))
            && (!array_key_exists('from_email', $campaign) || empty($campaign['from_email']))
            && (!array_key_exists('from_name', $campaign) || empty($campaign['from_name']))
            && (!array_key_exists('subject', $campaign) || empty($campaign['subject']))
        ) {
            throw new ConfigurationException('Your campaign must have properties: list_id, template_id, from_email, from_name and subject');
        }
        return $this->client->post('campaigns', $campaign);
    }

    /**
     * Summary information for the campaign specified that includes the name, ID, list, subject, from email address,
     * from name, status and date created.
     *
     * @param $campaignId
     * @return mixed
     */
    public function get($campaignId)
    {
        return $this->client->get("campaign/{$campaignId}");
    }

    /**
     * Update details of the campaign. You can update a campaign's name, subject, from email address, from name,
     * template or list.
     *
     * @param int $campaignId
     * @param array $campaign
     * @return mixed
     */
    public function update($campaignId, $campaign = [])
    {
        return $this->client->put("campaign/{$campaignId}", $campaign);
    }

    /**
     * The endpoint queues a campaign for immediate delivery.
     *
     * @param int $campaignId
     * @return mixed
     */
    public function send($campaignId)
    {
        return $this->client->post("campaign/{$campaignId}/send");
    }

    /**
     * Schedule a campaign for a time in the future.
     *
     * @param int $campaignId
     * @param array $params
     * @throws ConfigurationException
     * @return mixed
     */
    public function schedule($campaignId, $params)
    {
        if ((!array_key_exists('send_time', $params) || empty($params['send_time']))) {
            throw new ConfigurationException('You must provide send_time to schedule campaign');
        }
        return $this->client->post("campaign/{$campaignId}/schedule");
    }

    /**
     * Cancel a campaign send. Marks a campaign as cancelled regardless of it's current status.
     *
     * @param int $campaignId
     * @return mixed
     */
    public function cancel($campaignId)
    {
        return $this->client->post("campaign/{$campaignId}/cancel");
    }

    /**
     * Create a copy of a campaign. The new campaign starts as a draft.
     *
     * @param int $campaignId
     * @param array $params
     * @throws ConfigurationException
     * @return mixed
     */
    public function duplicate($campaignId, $params)
    {
        if (
            (!array_key_exists('name', $params) || empty($params['name']))
            && (!array_key_exists('list_id', $params) || empty($params['list_id']))
        )
        {
            throw new ConfigurationException('You must have name and list_id');
        }
        return $this->client->post("campaign/{$campaignId}/clone");
    }
}