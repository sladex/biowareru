<?php

namespace biowareru\frontend\controllers;


use bioengine\common\BioEngine;
use bioengine\common\modules\gallery\models\GalleryCat;
use bioengine\common\modules\gallery\models\GalleryPic;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class GalleryController extends \bioengine\common\modules\gallery\controllers\frontend\GalleryController
{
    public $breadCrumbs = [];

    public function actionCat($parentUrl, $catUrl)
    {
        $parent = BioEngine::getParentByUrl($parentUrl);
        if (!$parent) {
            throw new NotFoundHttpException;
        }

        /**
         * @var GalleryCat $cat
         */
        $cat = GalleryCat::find()->where(['url' => $catUrl, $parent->parentKey => $parent->id])->one();
        if (!$cat) {
            throw new NotFoundHttpException;
        }
        $picsQuery = GalleryPic::find()->orderBy([
            'id' => SORT_DESC
        ])->where(['pub' => 1, 'cat_id' => $cat->id]);
        $pagination = new Pagination(['totalCount' => $picsQuery->count(), 'pageSize' => 24]);

        $pics = $picsQuery->offset($pagination->offset)
            ->limit($pagination->limit)->all();


        $parentCat = $cat->parent;
        while ($parentCat) {
            $this->breadCrumbs[] = [
                'title' => $parentCat->title,
                'url'   => $parentCat->getPublicUrl()
            ];
            $parentCat = $parentCat->parent;
        }
        $this->breadCrumbs[] = [
            'title' => $parent->title,
            'url'   => $parent->getPublicUrl()
        ];
        $this->breadCrumbs[] = [
            'title' => 'Галерея',
            'url'   => $parent->getGalleryUrl()
        ];

        array_reverse($this->breadCrumbs);

        return $this->render('@app/static/tmpl/p-gallery.twig',
            ['parent' => $parent, 'cat' => $cat, 'pics' => $pics, 'pagination' => $pagination]);
    }
}