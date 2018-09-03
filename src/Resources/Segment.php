<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Exceptions\ConfigurationException;

/**
 * The Lists & List Management API is used for creating and managing lists in Klaviyo
 *
 * @see https://www.klaviyo.com/docs/api/lists
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Segment extends BaseSecretResource
{

    /**
     * List objects represent standard (e.g. not dynamic) lists of people. With lists, you can send campaigns and
     * manage individual subscriptions.
     *
     * @param array $options
     * @return mixed
     */
    public function all($options = [])
    {
        return $this->client->get('lists', $options);
    }

    /**
     * Create a new list. Currently this resources only supports creating standard lists.
     *
     * @param array $list
     * @throws ConfigurationException
     * @return mixed
     */
    public function create($list)
    {
        if ((!array_key_exists('name', $list) || empty($list['name'])) && (!array_key_exists('list_type', $list) || empty($list['name']))) {
            throw new ConfigurationException();
        }
        return $this->client->post('lists', $list);
    }

    /**
     * Summary information for the list specified that includes the name, ID, type, number of members, when it was
     * created and last updated.
     *
     * @param int $listId
     * @return mixed
     */
    public function get($listId)
    {
        return $this->client->get("list/{$listId}");
    }

    /**
     * Update details of the list. Currently this only support updating the name of the list.
     *
     * @param int $listId
     * @param array $list
     * @throws ConfigurationException
     * @return mixed
     */
    public function update($listId, $list)
    {
        if ((!array_key_exists('name', $list) || empty($list['name']))) {
            throw new ConfigurationException();
        }
        return $this->client->put("list/{$listId}", $list);
    }

    /**
     * Deletes a list. This will also disable any autoresponders associated with this list.
     *
     * @param int $listId
     *
     * @return mixed
     */
    public function delete($listId)
    {
        return $this->client->delete("list/{$listId}");
    }

    /**
     *  Check if one or more people are already members of the specified list, based on their e-mail addresses. No
     * distinction is made between a person not being subscribed to the list, and not being present in Klaviyo at all.
     *
     * @param int $listId
     * @param array $member
     * @throws ConfigurationException
     * @return mixed
     */
    public function checkMemberInList($listId, $member)
    {
        if (!array_key_exists('email', $member) || empty($member['email'])) {
            throw new ConfigurationException('You should provide email for member');
        }
        return $this->client->get("list/{$listId}/members", $member);
    }

    /**
     * Check if one or more people are already members of the specified segment, based on their e-mail addresses. No
     * distinction is made between a person not being subscribed to the segment, and not being present in Klaviyo at
     * all.
     *
     * @param int $segmentId
     * @param array $member
     * @throws ConfigurationException
     * @return mixed
     */
    public function checkMemberInSegment($segmentId, $member)
    {
        if (!array_key_exists('email', $member) || empty($member['email'])) {
            throw new ConfigurationException('You should provide email for member');
        }
        return $this->client->get("segment/{$segmentId}/members", $member);
    }

    /**
     * Adds a new person to the specified list. If a person with that email address does not already exist, a new
     * person is first added to Klaviyo. If someone is unsubscribed from the specified list, they will not be
     * subscribed. To re-subscribe someone, you must manually remove them from the unsubscribe list in Klaviyo on the
     * members page for the specified list.
     *
     * @param int $listId
     * @param array $member
     * @throws ConfigurationException
     * @return mixed
     */
    public function addMemberToList($listId, $member)
    {
        if (!array_key_exists('email', $member) || empty($member['email'])) {
            throw new ConfigurationException('You should provide email for member');
        }
        return $this->client->post("list/{$listId}/members", $member);
    }

    /**
     * Adds multiple people to the specified list. For each person, if a person with that email address does not
     * already exist, a new person is first added to Klaviyo. If someone is unsubscribed from the specified list, they
     * will not be subscribed. To re-subscribe someone, you must manually remove them from the unsubscribe list in
     * Klaviyo on the members page for the specified list.
     *
     * @param int $listId
     * @param array $members
     * @return mixed
     */
    public function batchAddMembersToList($listId, $members)
    {
        return $this->client->post("list/{$listId}/members/batch", $members);
    }

    /**
     * Removes multiple people from the specified list. For each person, if a person with that email address is a
     * member of that list, they are removed.
     *
     * @param $listId
     * @param $members
     * @return mixed
     */
    public function batchRemoveMembersFromList($listId, $members)
    {
        return $this->client->delete("list/{$listId}/members/batch", $members);
    }

    /**
     * Marks a person as excluded from the specified list
     *
     * @param $listId
     * @param $member
     * @throws ConfigurationException
     * @return mixed
     */
    public function unsubscribeMemberFromList($listId, $member)
    {
        if(!array_key_exists('email', $member) || empty($member['email'])) {
            throw new ConfigurationException('You should provide email');
        }
        return $this->client->post("list/{$listId}/members/exclude", $member);
    }

    /**
     * Get all the exclusions for the specified list.
     *
     * @param $listId
     * @param array $options
     * @return array
     */
    public function listExclusionInList($listId, $options = [])
    {
        return $this->client->get("list/{$listId}/exclusions", $options);
    }

    /**
     * Get global exclusions or unsubscribes
     *
     * @param array $options
     * @return mixed
     */
    public function listExclusion($options = [])
    {
        return $this->client->get("people/exclusions", $options);
    }

    /**
     * Marks a person as excluded from all email.
     *
     * @param $member
     * @return mixed
     */
    public function unsubscribeMember($member) {
        return $this->client->post("people/exclusions", $member);
    }
}