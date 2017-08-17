<?php
/**
*易 福 源 码 网 www.efwww.com
*/
defined('IN_IA') or exit('Access Denied');
class Tim_stralbumModuleProcessor extends WeModuleProcessor
{
    public function respond()
    {
        $content = $this->message['content'];
        $reply   = pdo_fetchall("SELECT * FROM " . tablename('stralbum_reply') . " WHERE rid = :rid", array(
            ':rid' => $this->rule
        ));
        if (!empty($reply)) {
            foreach ($reply as $row) {
                $albumids[$row['albumid']] = $row['albumid'];
            }
            $album    = pdo_fetchall("SELECT id, title, thumb, content FROM " . tablename('stralbum') . " WHERE id IN (" . implode(',', $albumids) . ")", array(), 'id');
            $response = array();
            foreach ($reply as $row) {
                $row        = $album[$row['albumid']];
                $response[] = array(
                    'title' => $row['title'],
                    'description' => $row['content'],
                    'picurl' => toimage($row['thumb']),
                    'url' => $this->buildSiteUrl($this->createMobileUrl('detail', array(
                        'id' => $row['id']
                    )))
                );
            }
            return $this->respNews($response);
        }
    }
}