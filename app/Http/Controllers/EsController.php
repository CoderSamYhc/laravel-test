<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class EsController extends Controller
{
    //
    public function search(Request $request)
    {
        $client = ClientBuilder::create()
            ->setHosts(['es'])->build();
        $params = $request->toArray();
        $searchQuery = [
            "index" => 'account', // 索引
            'type' => 'person', // 类型
            'body' => [ // body为空会返回全部数据
                'query' => [ // 查询条件
//                    'match' => [ // match 查询
//                        'desc' => $params['search']
//                    ]
//                    'bool' => [ // Bool 查询
//                        'must' => [
//                            ['match' => ['desc' => '运动']],
//                            ['match' => ['desc' => '篮球']],
//                        ]
//                        'filter' => [ // 过滤器
//                            'terms' => [ // terms 查询,严格匹配条件，类似于SQL中in关键字的用法
//                                'title' => ['运动员','工程师']
//                            ]
//                        ],
//                        'should' => [
//                            'match' => ['desc' => '销售']
//                        ]
//                    ],
//                    'term' => [ // term 查询 严格匹配条件，所查询的字段内容要与填入查询框搜索值一致
//                        'title' => '运动员'
//                    ],
//                    'terms' => [ // terms 查询,严格匹配条件，类似于SQL中in关键字的用法
//                        'title' => ['运动员','工程师']
//                    ]

                ],
//                'size' => 10, // 控制返回数量
//                'from' => 0, // 返回数据的位置，默认从0开始
            ]
        ];
        $result = $client->search($searchQuery);
        return response()->json($result);

    }

    public function update(Request $request)
    {
        $client = ClientBuilder::create()
            ->setHosts(['es'])->build();
        $params = $request->toArray();

        $data = [
            'index' => 'account',
            'type' => 'person',
//            'id' => '',
            'body' => [
                'script' => [
                    'inline' => "ctx._source.title=params.title",
                    'params' => [
                        'title' => '销售人员',
//                    'desc' => '产品销售员'
                    ],
                ],
                'query' => [
                    'term' => [
                        'title' => '销售人员'
                    ],
                ],


//                'doc' => [
//                    'title' => '销售人员',
//                    'desc' => '产品销售员'
//                ],
            ]
        ];
        $result = $client->updateByQuery($data);
        return response()->json($result);
    }
}
