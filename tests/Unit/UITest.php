<?php

namespace LaravelViews\Test\Unit;

use DOMDocument;
use LaravelViews\Facades\UI;
use LaravelViews\Test\TestCase;

class UITest extends TestCase
{
    public function testBagdeDefaultHelper()
    {
        $badge = UI::badge('active');
        $expected = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full '.variants('badges.default').'">
                        active
                    </span>';

        $this->assertHtmlEquals($badge, $expected);
    }

    public function testBagdeSuccesstHelper()
    {
        $badge = UI::badge('active', 'success');
        $expected = '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full '.variants('badges.success').'">
                        active
                    </span>';

        $this->assertHtmlEquals($badge, $expected);
    }

    public function testAvatarHelper()
    {
        $avatar = UI::avatar('my-avatar-url');
        $expected = '<img src="my-avatar-url" alt="my-avatar-url" class="'.variants('images.avatar').'">';

        $this->assertHtmlEquals($avatar, $expected);
    }

    public function testLinkHelper()
    {
        $link = UI::link('title', '/');
        $expected = '<a href="/" class="'.(variants('links.default')).'">
                        title
                    </a>';

        $this->assertHtmlEquals($link, $expected);
    }

    public function testDefaultIconHelper()
    {
        $icon = UI::icon('activity');
        $expected = '<i data-feather="activity" class=" "></i>';

        $this->assertHtmlEquals($icon, $expected);
    }

    public function testIconHelperWithVariant()
    {
        $icon = UI::icon('activity', 'success');
        $expected = '<i data-feather="activity" class="'.variants('icons.success').' "></i>';

        $this->assertHtmlEquals($icon, $expected);
    }

    private function assertHtmlEquals($html, $expected)
    {
        $this->assertEquals(
            preg_replace('/^\s+|\n|\r|\s+$/m', '', $html),
            preg_replace('/^\s+|\n|\r|\s+$/m', '', $expected)
        );
    }
}
