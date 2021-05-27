<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Facades\UI;
use LaravelViews\Test\TestCase;

class UITest extends TestCase
{
    public function testBagdeDefaultHelper()
    {
        $badge = UI::badge('active');
        $this->blade($badge)
            ->assertSeeText('active');
    }

    public function testBagdeSuccesstHelper()
    {
        $badge = UI::badge('active', 'success');
        $this->blade($badge)
            ->assertSeeText('active')
            ->assertSee(variants('badges.success'));
    }

    public function testAvatarHelper()
    {
        $avatar = UI::avatar('my-avatar-url');
        $this->blade($avatar)
            ->assertSee(variants('images.avatar'));
    }

    public function testLinkHelper()
    {
        $link = UI::link('title', '/');
        $this->blade($link)
            ->assertSee(variants('links.default'))
            ->assertSeeText('title');
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
        $expected = '<i data-feather="activity" class="text-green-500 "></i>';

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
