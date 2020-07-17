<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Admin\DataMapper\SakuraMapper;
use Admin\Table\Table;
use Faker\Factory;
use Lyrasoft\Luna\Admin\DataMapper\TagMapMapper;
use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace -- Ignore seeder file

/**
 * The SakuraSeeder class.
 *
 * @since  1.0
 */
class SakuraSeeder extends AbstractSeeder
{
    /**
     * doExecute
     *
     * @return  void
     */
    public function doExecute()
    {
        $faker = $this->faker->create();
        $userIds = range(20, 100);
        $img = $faker->imageUrl();
        $tagIds = \Lyrasoft\Luna\Admin\DataMapper\TagMapper::findColumn('id');
        $tagTypes = [
            'foo',
            'bar',
            'yoo'
        ];

        for ($i = 0; $i < 500000; $i++) {
            $created = $faker->dateTimeThisYear;
            $data    = new Data();

            $data['title']       = static::replaceTargetText($faker->sentence(3));
            $data['alias']       = 'sakura-' . $i;
            $data['url']         = '';
            $data['introtext']   = static::replaceTargetText($faker->paragraph(5));
            $data['fulltext']    = static::replaceTargetText($faker->paragraph(5));
            $data['image']       = $img;
            $data['state']       = 1;
            $data['created']     = $created->format($this->getDateFormat());
            $data['created_by']  = $faker->randomElement($userIds);
            $data['modified']    = $created->modify('+5 days')->format($this->getDateFormat());
            $data['modified_by'] = $faker->randomElement($userIds);
            $data['language']    = 'en-GB';
            $data['params']      = '';

            $sakura = SakuraMapper::createOne($data);

            foreach ($faker->randomElements($tagIds, 10) as $tagId) {
                TagMapMapper::createOne(
                    [
                        'tag_id' => $tagId,
                        'type' => $faker->randomElement($tagTypes),
                        'target_id' => $sakura->id
                    ]
                );
            }

            $this->outCounting();
        }
    }

    protected static function replaceTargetText(string $text): string
    {
        return str_replace('exercitationem', 'I Love You', $text);
    }

    /**
     * doClear
     *
     * @return  void
     */
    public function doClear()
    {
        $this->truncate(Table::SAKURAS);
    }
}
