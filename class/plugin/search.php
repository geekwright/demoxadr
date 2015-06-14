<?php
/**
 * include/search.php - search demoxadr todo items
 *
 * @package   Demoxadr
 * @author    Richard Griffith <richard@geekwright.com>
 * @copyright 2013-2015 XOOPS Project (http://xoops.org)
 * @license   GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link      http://xoops.org
 */

use Xoops\Module\Plugin\PluginAbstract;
use Xmf\Metagen;

class DemoxadrSearchPlugin extends PluginAbstract implements SearchPluginInterface
{
    /**
     * search - search
     *
     * @param string[] $queryArray search terms
     * @param string   $andor      and/or how to treat search terms
     * @param integer  $limit      max number to return
     * @param integer  $offset     offset of first row to return
     * @param integer  $userid     a specific user id to limit the query
     *
     * @return array of result items
     *           'title' => the item title
     *           'content' => brief content or summary
     *           'link' => link to visit item
     *           'time' => time modified (unix timestamp)
     *           'uid' => author uid
     *           'image' => icon for search display
     *
     */
    public function search($queryArray, $andor, $limit, $offset, $userid)
    {
        $andor = strtolower($andor)=='and' ? 'and' : 'or';

        $qb = \Xoops::getInstance()->db()->createXoopsQueryBuilder();
        $eb = $qb->expr();
        $qb ->select('DISTINCT *')
            ->fromPrefix('demoxadr_todo')
            ->where($eb->eq('todo_active', 1))
            ->orderBy('todo_input_date', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        if (is_array($queryArray) && !empty($queryArray)) {
            $queryParts = array();
            foreach ($queryArray as $i => $q) {
                $qterm = ':qterm' . $i;
                $qb->setParameter($qterm, '%' . $q . '%', \PDO::PARAM_STR);
                $queryParts[] = $eb -> orX(
                    $eb->like('todo_subject', $qterm),
                    $eb->like('todo_description', $qterm)
                );
            }
            if ($andor == 'and') {
                $qb->andWhere(call_user_func_array(array($eb, "andX"), $queryParts));
            } else {
                $qb->andWhere(call_user_func_array(array($eb, "orX"), $queryParts));
            }
        } else {
            $qb->setParameter(':uid', (int) $userid, \PDO::PARAM_INT);
            $qb->andWhere($eb->eq('todo_uid', ':uid'));
        }

        $myts = MyTextSanitizer::getInstance();
        $items = array();
        $result = $qb->execute();
        while ($myrow = $result->fetch(\PDO::FETCH_ASSOC)) {
            $content = $myrow["todo_description"];
            $content = $myts->xoopsCodeDecode($content);
            $items[] = array(
                'title' => $myrow['todo_subject'],
                'content' => Metagen::getSearchSummary($content, $queryArray),
                'link' => "index.php?action=TodoDetail&todo_id=" . $myrow["todo_id"],
                'time' => $myrow['todo_input_date'],
                'uid' => $myrow['todo_uid'],
                'image' => 'images/logo_small.png',
            );
        }
        return $items;
    }
}
