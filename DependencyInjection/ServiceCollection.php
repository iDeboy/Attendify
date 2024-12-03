<?php
declare(strict_types=1);

namespace DependencyInjection;

use ArrayAccess;
use BadMethodCallException;
use Closure;
use Iterator;

class ServiceCollection implements ArrayAccess, Iterator {

    private int $pos = 0;

    private array $descriptors = [];
    private bool $isReadOnly = false;

    public function count(): int {
        return count($this->descriptors);
    }
    public function is_readonly() {
        return $this->isReadOnly;
    }
    public function clear() {
        $this->check_readonly();
        $this->descriptors = [];
    }
    public function copy_to(array &$destination) {

        $destination = [...$this->descriptors];
    }

    public function add(ServiceDescriptor $descriptor): self {

        $this->check_readonly();

        $this->descriptors[] = $descriptor;

        return $this;
    }
    public function add_singleton(string $serviceType, Closure|callable|string|null $implementation = null) {
        return $this->add(ServiceDescriptor::singleton($serviceType, $implementation));
    }
    public function add_transient(string $serviceType, Closure|callable|string|null $implementation = null) {
        return $this->add(ServiceDescriptor::transient($serviceType, $implementation));
    }

    public function current(): ServiceDescriptor {
        return $this->descriptors[$this->pos];
    }
    public function key(): int {
        return $this->pos;
    }
    public function next(): void {
        ++$this->pos;
    }
    public function rewind(): void {
        $this->pos = 0;
    }
    public function valid(): bool {
        return isset($this->descriptors[$this->pos]);
    }

    public function offsetExists(mixed $offset): bool {

        if (!($offset instanceof int)) return false;

        return isset($this->descriptors[$offset]);
    }
    public function offsetGet(mixed $offset): ?ServiceDescriptor {

        if (!($offset instanceof int)) return false;

        return isset($this->descriptors[$offset]) ? $this->descriptors[$offset] : null;
    }
    public function offsetSet(mixed $offset, mixed $value): void {

        if (!($offset instanceof int)) return;

        $this->check_readonly();
        $this->descriptors[$offset] = $value;
    }
    public function offsetUnset(mixed $offset): void {

        if (!($offset instanceof int)) return;

        $this->check_readonly();
        unset($this->descriptors[$offset]);
    }

    public function make_readonly() {
        $this->isReadOnly = true;
    }
    private function check_readonly() {

        if ($this->isReadOnly) {
            throw new BadMethodCallException('Colección de servicios está en solo lectura.');
        }
    }
}
