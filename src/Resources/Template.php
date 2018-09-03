<?php

namespace Baorv\Klaviyo\Resources;

use Baorv\Klaviyo\Exceptions\ConfigurationException;

/**
 * The Templates API is used for interacting with email templates stored in Klaviyo.
 *
 * @see https://www.klaviyo.com/docs/api/email-templates
 * @package Baorv\Klaviyo\Resources
 * @author baorv <roanvanbao@gmail.com>
 * @version 0.0.1
 */
class Template extends BaseSecretResource
{
    /**
     * Returns a list of all the email templates you've created.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->client->get('email-templates');
    }

    /**
     * Creates a new email template.
     *
     * @param $template
     * @throws ConfigurationException
     * @return mixed
     */
    public function create($template)
    {
        if (
            (!array_key_exists('name', $template) || empty($template['name']))
            && (!array_key_exists('html', $template) || empty($template['html']))
        ) {
            throw new ConfigurationException('You must provide name and html of template');
        }
        return $this->client->post('email-templates', $template);
    }

    /**
     * Updates the name and/or HTML content of a template. Only updates imported HTML templates; does not currently
     * update drag & drop templates.
     *
     * @param int $templateId
     * @param array $template
     * @return mixed
     */
    public function update($templateId, $template)
    {
        return $this->client->put("email-template/{$templateId}", $template);
    }

    /**
     * Deletes a given template.
     *
     * @param $templateId
     * @return mixed
     */
    public function delete($templateId)
    {
        return $this->client->delete("email-template/{$templateId}");
    }

    /**
     * Creates a copy of a given template with a new name.
     *
     * @param $templateId
     * @param $template
     * @throws ConfigurationException
     * @return mixed
     */
    public function duplicate($templateId, $template)
    {
        if (!array_key_exists('name', $template) || empty($template['name'])) {
            throw new ConfigurationException('You must provide name of new template');
        }
        return $this->client->post("email-template/{$templateId}/clone");
    }
}