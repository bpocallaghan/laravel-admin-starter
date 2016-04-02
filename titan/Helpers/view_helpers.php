<?php

if (!function_exists('form_error_class')) {
    function form_error_class($attribute, $errors)
    {
        return $errors->first($attribute, 'has-error');
    }
}

if (!function_exists('form_error_message')) {
    function form_error_message($attribute, $errors)
    {
        return $errors->first($attribute,
            '<i><small for="' . $attribute . '" class="text-red">:message</small></i>');
    }
}

if (!function_exists('format_date')) {
    /**
     * Format Date
     *
     * @param        $date
     * @param string $format
     * @return bool|string
     */
    function format_date($date, $format = "d F Y")
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('action_row')) {
    /**
     * Get the html for the actions for a table list
     * @param            $url
     * @param            $id
     * @param            $title
     * @param array      $actions
     * @return string
     */
    function action_row($url, $id, $title, $actions = ['show', 'edit', 'delete'])
    {
        $show = '<div class="btn-group">
				    <a href="' . $url . $id . '" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Show ' . $title . '">
					    <i class="fa fa-eye"></i>
				    </a>
			    </div>';

        $edit = '<div class="btn-group">
				    <a href="' . $url . $id . '/edit' . '" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit ' . $title . '">
					    <i class="fa fa-edit"></i>
				    </a>
			    </div>';

        $delete = '<div class="btn-group">
				        <form id="form-delete-row' . $id . '" method="POST" action="' . $url . $id . '">
				        <input name="_method" type="hidden" value="DELETE">
				        <input name="_token" type="hidden" value="' . csrf_token() . '">
					    <input name="_id" type="hidden" value="' . $id . '">
					    <a data-form="form-delete-row' . $id . '" class="btn btn-primary btn-xs btn-delete-row" data-toggle="tooltip" title="Delete ' . $title . '">
						    <i class="fa fa-times"></i>
					    </a>
					    </form>
				    </div>';

        $html = '';
        foreach ($actions as $k => $action) {
            if ($action == 'show') {
                $html .= $show;
            }
            if ($action == 'edit') {
                $html .= $edit;
            }
            if ($action == 'delete') {
                $html .= $delete;
            }

            if (is_array($action)) {
                $key = key($action);
                $urll = $action[$key];

                $html .= '<div class="btn-group">
                    <a href="' . $urll . '" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Show ' . $key . ' for ' . $title . '">
                        <i class="fa fa-' . $key . '"></i>
                    </a>
                </div>';
            }
        }

        return '<div class="btn-toolbar">' . $html . '</div>';
    }
}

if (!function_exists('profile_image')) {

    /**
     * Return the path of the logged in user's profile image
     * @return string
     */
    function profile_image()
    {
        $image = user()->image;
        $gender = user()->gender;
        if ($image && strlen($image) > 5) {
            return '/uploads/images/' . $image;
        }
        else {
            return "/images/admin/$gender.png";
        }
    }
}

if (!function_exists('activitiy_after')) {
    /**
     * Get the After Title of model
     * @param $activity
     * @return string
     */
    function activitiy_after($activity)
    {
        if (strlen($activity->after) > 3) {
            return $activity->after;
        }
        else if (isset($activity->subject->title)) {
            return $activity->subject->title;
        }

        return '';
    }
}

function image_row_link($thumb, $image = null)
{
    return "<a target='_blank' href='" . uploaded_images_url(($image ? $image : $thumb)) . "'><img src='" . uploaded_images_url($thumb) . "' style='height: 50px'/></a>";
}