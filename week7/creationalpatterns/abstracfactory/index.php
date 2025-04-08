<?php
// Abstract Product: Button
interface Button {
    public function render();
}

// Concrete Product: WindowsButton
class WindowsButton implements Button {
    public function render() {
        echo "Rendering Windows Button\n";
    }
}

// Concrete Product: MacButton
class MacButton implements Button {
    public function render() {
        echo "Rendering Mac Button\n";
    }
}

// Abstract Product: Checkbox
interface Checkbox {
    public function render();
}

// Concrete Product: WindowsCheckbox
class WindowsCheckbox implements Checkbox {
    public function render() {
        echo "Rendering Windows Checkbox\n";
    }
}

// Concrete Product: MacCheckbox
class MacCheckbox implements Checkbox {
    public function render() {
        echo "Rendering Mac Checkbox\n";
    }
}

// Abstract Factory
interface GUIFactory {
    public function createButton(): Button; 
    public function createCheckbox(): Checkbox;
}

// Concrete Factory: WindowsFactory
class WindowsFactory implements GUIFactory {
    public function createButton(): Button {
        return new WindowsButton();
    }
    
    public function createCheckbox(): Checkbox {
        return new WindowsCheckbox();
    }
}

// Concrete Factory: MacFactory
class MacFactory implements GUIFactory {
    public function createButton(): Button {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox {
        return new MacCheckbox();
    }
}

class Application {
    private $button;
    private $checkbox;

    public function __construct(GUIFactory $factory) {
        $this->button = $factory->createButton();
        $this->checkbox = $factory->createCheckbox();
    }

    public function renderUI() {
        $this->button->render();
        $this->checkbox->render();
    }
}

// Client usage
// Tạo đối tượng ứng dụng với WindowsFactory
$app = new Application(new WindowsFactory());
$app->renderUI();

// Tạo đối tượng ứng dụng với MacFactory
$app = new Application(new MacFactory());
$app->renderUI();