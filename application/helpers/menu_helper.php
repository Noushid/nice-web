<?php
/**
 * Created by PhpStorm.
 * User: psybo-03
 * Date: 9/2/17
 * Time: 5:04 PM
 */

function dashboard_menu()
{
    $menu = [
        'dashboard' => [
            'title' => 'dashboard',
            'icon' => 'fa-tachometer',
            'link' => '/'
        ],
        'slide image' => [
            'title' => 'slide image',
            'icon' => 'fa-picture-o',
            'link' => 'slide-images'
        ],
        'news' => [
            'title' => 'news',
            'icon' => 'fa-newspaper-o',
            'link' => 'news'
        ],
        'brochure' => [
            'title' => 'brochure',
            'icon' => 'fa-file-pdf-o',
            'link' => 'brochures'
        ],
        'gallery' => [
            'title' => 'gallery',
            'icon' => 'fa-picture-o',
            'link' => 'gallery'
        ],
        'helpful link' => [
            'title' => 'helpful link',
            'icon' => 'fa-external-link',
            'link' => 'helpful-links'
        ],
        'blog' => [
            'title' => 'blog',
            'icon' => 'fa-comment',
            'link' => 'blog'
        ]
    ];

    $html = '<nav class="sidebar-left">
        <div class="">
          <ul class="menu-left">
            <li>
              <div class="user-img">
                <img class="img-responsive img-circle center-block" src="' . public_url() . 'assets/img/logo/logo.png" alt="User">
              </div>
              <div class="user-id text-center">
                <span class="">Fasalu Rahman</span>
              </div>
            </li>';
    foreach ($menu as $key => $value) {
        $html .= '<li><a href="' . base_url('admin/#'.$value['link']) . '" ng-class="{active : url == \'' . $value['link'] . '\'}">'.ucfirst($value['title']).' &nbsp;<i class="menu-icon fa '.$value['icon'].' pull-right"></i></a></li>';
    }

    $html .='</ul>
        </div>
      </nav>';

    return $html;
}

function menu($current)
{
    $menu = [
        'Home' => [
            'title' => 'Home',
            'icon' => '',
            'link' => 'home'
        ],
        'About Us' => [
            'title' => 'About Us',
            'icon' => '',
            'link' => 'about',
            'sub' => [
                'about us' => [
                    'title' => 'about company',
                    'icon' => '',
                    'link' => 'about#aboutus',
                ],
                'team' => [
                    'title' => 'our team',
                    'icon' => '',
                    'link' => 'team',
                ]
            ]
        ],
        'Our Services' => [
            'title' => 'Our Services',
            'icon' => '',
            'link' => 'services',
            'sub' => [
                'typing services' => [
                    'title' => 'typing service',
                    'icon' => '',
                    'link' => 'services#services1',
                ],
                'services for ministry health' => [
                    'title' => 'services for ministry health',
                    'icon' => '',
                    'link' => 'services#services2',
                ],
                'services for higher & lower education' => [
                    'title' => 'services for higher & lower education',
                    'icon' => '',
                    'link' => 'services#services3',
                ],
                'medical fingerprint assists services' => [
                    'title' => 'medical fingerprint assists services',
                    'icon' => '',
                    'link' => 'services#services4',
                ],
                'insurance services' => [
                    'title' => 'insurance services',
                    'icon' => '',
                    'link' => 'services#services5',
                ],
                'health insurance services' => [
                    'title' => 'health insurance services',
                    'icon' => '',
                    'link' => 'services#services6',
                ],
                'education services' => [
                    'title' => 'education services',
                    'icon' => '',
                    'link' => 'services#services7',
                ],
                'transportation services' => [
                    'title' => 'transportation services',
                    'icon' => '',
                    'link' => 'services#services8',
                ],
                'pan card services' => [
                    'title' => 'pan card services',
                    'icon' => '',
                    'link' => 'services#services9',
                ],
                'air tickets and related services' => [
                    'title' => 'air tickets and related services',
                    'icon' => '',
                    'link' => 'services#services10',
                ],
                'courier services' => [
                    'title' => 'courier services',
                    'icon' => '',
                    'link' => 'services#services11',
                ],
                'miscellaneous services' => [
                    'title' => 'miscellaneous services',
                    'icon' => '',
                    'link' => 'services#services12',
                ]
            ]
        ],
        'Moments' => [
            'title' => 'Moments',
            'icon' => '',
            'link' => 'moments'
        ],
        'Blog' => [
            'title' => 'Blog',
            'icon' => '',
            'link' => 'blog'
        ],
        'Contact' => [
            'title' => 'Contact',
            'link' => 'contact'
        ]
    ];

    $html = '';
    foreach ($menu as $key=>$value) {
        if (isset($value['sub'])) {
            if ($key == $current) {
                $html .= '<li class="active">' .PHP_EOL.
                    '<a href="' . $value['link'] . '">' . ucwords($value['title']) . '</a>' . PHP_EOL .
                    '<ul class="dropdown">' . PHP_EOL;
                foreach ($value['sub'] as $sub) {
                    $html .= '<li><a href="' . $sub['link'] . '">' . ucwords($sub['title']) . '</a></li>'. PHP_EOL;
                }
            } else {
                $html .= '<li>' .PHP_EOL.
                    '<a href="' . $value['link'] . '">' . ucwords($value['title']) . '</a>' . PHP_EOL .
                    '<ul class="dropdown">' . PHP_EOL;
                foreach ($value['sub'] as $sub) {
                    $html .= '<li><a href="' . $sub['link'] . '">' . ucwords($sub['title']) . '</a></li>'. PHP_EOL;
                }
            }

            $html .= '</ul>' . PHP_EOL;
            $html .= '</li>' . PHP_EOL;

        }else{
            if ($key == $current) {
                $html .= '<li class="active"><a href="' . base_url($value['link']) . '">' . $key . '</a></li>' . PHP_EOL;
            }else{
                $html .= '<li><a href="' . base_url($value['link']) . '">' . $key . '</a></li>' . PHP_EOL;
            }
        }

    }
    return $html;
}
