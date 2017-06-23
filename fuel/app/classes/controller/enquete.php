<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

class Controller_Enquete extends Controller_Template
{
    /**
     * action_index form view
     *
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
        if(Input::method() === 'POST')
        {
            $val = \Formvalidation\Enquete::send();

            if ($val->run())
            {
                // TODO: DB保存
                $_enqute = [
                    'name'    => $val->validated('name'),
                    'best'    => $val->validated('best'),
                    'remarks' => $val->validated('remarks'),
                ];

                $enquete = Model_Enquete::forge($_enqute);
                $enquete->save();

                Response::redirect('thanks');
            }
            else
            {
                $this->template->set_global('error', $val->error());
            }
        }

        $this->template->set_global('enquetes', Config::get('enquete.enquete'));
        $this->template->content = View::forge('enquete/index');
    }

    /**
     * action_thanks
     *
     * @access  public
     * @return  Response
     */
    public function action_thanks()
    {
        $this->template->content = View::forge('enquete/thanks');
    }
}
