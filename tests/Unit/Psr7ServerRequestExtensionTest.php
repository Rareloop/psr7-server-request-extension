<?php

namespace Rareloop\Psr7ServerRequestExtension\Test;

use PHPUnit\Framework\TestCase;
use Rareloop\Psr7ServerRequestExtension\Test\TestDiactorosServerRequest as ServerRequest;

class Psr7ServerRequestExtensionTest extends TestCase
{
    /** @test */
    public function can_get_path()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET');

        $this->assertSame('/test/123', $request->path());
    }

    /** @test */
    public function can_get_url_without_query_string()
    {
        $request = new ServerRequest([], [], 'https://test.com/test/123?foo=bar', 'GET');

        $this->assertSame('https://test.com/test/123', $request->url());
    }

    /** @test */
    public function can_get_url_with_query_string()
    {
        $request = new ServerRequest([], [], 'https://test.com/test/123?foo=bar', 'GET');

        $this->assertSame('https://test.com/test/123?foo=bar', $request->fullUrl());
    }

    /** @test */
    public function no_trailing_question_mark_is_added_when_no_query_params_are_present()
    {
        $request = new ServerRequest([], [], 'https://test.com/test/123', 'GET');

        $this->assertSame('https://test.com/test/123', $request->fullUrl());
    }

    /** @test */
    public function can_check_method()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET');

        $this->assertTrue($request->isMethod('get'));
        $this->assertTrue($request->isMethod('GET'));
        $this->assertFalse($request->isMethod('post'));
        $this->assertFalse($request->isMethod('POST'));
    }

    /** @test */
    public function can_get_all_input()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $input = $request->input();

        $this->assertSame('bar', $input['foo']);
        $this->assertSame('qux', $input['baz']);
    }

    /** @test */
    public function can_get_specific_input_with_key()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $this->assertSame('bar', $request->input('foo'));
        $this->assertSame('qux', $request->input('baz'));
    }

    /** @test */
    public function can_get_default_when_key_is_not_found_in_input()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET');

        $this->assertSame('bar', $request->input('foo', 'bar'));
    }

    /** @test */
    public function can_check_if_input_has_a_specific_key()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar']);

        $this->assertTrue($request->has('foo'));
        $this->assertFalse($request->has('baz'));
    }

    /** @test */
    public function can_check_if_input_has_collection_of_keys()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $this->assertTrue($request->has(['foo', 'baz']));
    }

    /** @test */
    public function can_get_all_query()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $input = $request->query();

        $this->assertSame('bar', $input['foo']);
        $this->assertFalse(isset($input['baz']));
    }

    /** @test */
    public function can_get_specific_query_with_key()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $this->assertSame('bar', $request->query('foo'));
    }

    /** @test */
    public function can_get_default_when_key_is_not_found_in_query()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET');

        $this->assertSame('bar', $request->query('foo', 'bar'));
    }

    /** @test */
    public function can_get_all_post()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $input = $request->post();

        $this->assertSame('qux', $input['baz']);
        $this->assertFalse(isset($input['foo']));
    }

    /** @test */
    public function can_get_specific_post_with_key()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET', 'php://input', [], [], ['foo' => 'bar'], ['baz' => 'qux']);

        $this->assertSame('qux', $request->post('baz'));
    }

    /** @test */
    public function can_get_default_when_key_is_not_found_in_post()
    {
        $request = new ServerRequest([], [], '/test/123', 'GET');

        $this->assertSame('bar', $request->post('foo', 'bar'));
    }
}
