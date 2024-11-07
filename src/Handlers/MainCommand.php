<?php

declare(strict_types=1);

namespace Oscabrera\ModelRepository\Handlers;

use Illuminate\Console\Command;
use Illuminate\Console\View\Components\Factory;
use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Handlers\Makers\MakeController;
use Oscabrera\ModelRepository\Handlers\Makers\MakeInterfaceRepository;
use Oscabrera\ModelRepository\Handlers\Makers\MakeInterfaceServices;
use Oscabrera\ModelRepository\Handlers\Makers\MakeModel;
use Oscabrera\ModelRepository\Handlers\Makers\MakeRepository;
use Oscabrera\ModelRepository\Handlers\Makers\MakeRequest;
use Oscabrera\ModelRepository\Handlers\Makers\MakeService;
use Oscabrera\ModelRepository\Trait\MainCommandTrait;

class MainCommand
{
    use MainCommandTrait;

    protected Factory $output;

    protected Command $command;

    protected Options $options;

    protected string $name;

    /**
     * Constructor for the class.
     */
    public function __construct(
        protected MakeModel $makeModel,
        protected MakeRepository $makeRepository,
        protected MakeInterfaceRepository $makeInterfaceRepository,
        protected MakeService $makeService,
        protected MakeInterfaceServices $makeInterfaceServices,
        protected MakeController $makeController,
        protected MakeRequest $makeRequest,
    ) {}

    /**
     * Sets the output object to be used for displaying messages.
     */
    public function setOutput(Factory $output): void
    {
        $this->output = $output;
    }

    /**
     * Handles the command execution.
     */
    public function handle(
        Command $command,
        string $name,
        Options $options,
    ): void {
        $this->command = $command;
        $this->name = $name;
        $this->options = $options;
        $this->run();
    }

    /**
     * Executes the series of commands to generate the necessary files for a
     *  given resource.
     */
    public function run(): void
    {
        $this->makeModel();
        $this->makeInterfaceRepository();
        $this->makeRepository();
        $this->makeInterfaceService();
        $this->makeService();
        $this->makeController();
        $this->makeRequest();
    }

    /**
     * Displays an info message about a command.
     *
     * @param array{type: string, path: string} $info
     */
    public function infoCommand(array $info): void
    {
        $this->output->info(
            sprintf(
                '%s [%s] created successfully.',
                $info['type'],
                $info['path'],
            ),
        );
    }

    /**
     * Displays an error message.
     *
     * @param array{type: string, path: string} $info Additional information
     * about the error.
     */
    public function errorCommand(string $message, array $info): void
    {
        $this->output->error(sprintf('%s %s', $info['type'], $message));
    }

    /**
     * Creates a model based on the given name and options.
     */
    private function makeModel(): void
    {
        $this->makeModel->make($this->command, $this->name, $this->options);
    }

    /**
     * Executes the maker for creating an interface repository.
     */
    private function makeInterfaceRepository(): void
    {
        $this->executeMaker($this->makeInterfaceRepository);
    }

    /**
     * Executes the makeRepository method.
     */
    private function makeRepository(): void
    {
        $this->executeMaker($this->makeRepository);
    }

    /**
     * Make interface service.
     *
     *
     * If the options include a service, execute the maker for creating an interface services file.
     */
    private function makeInterfaceService(): void
    {
        if ($this->options->hasService()) {
            $this->executeMaker($this->makeInterfaceServices);
        }
    }

    /**
     * Make a service.
     */
    private function makeService(): void
    {
        if ($this->options->hasService()) {
            $this->executeMaker($this->makeService);
        }
    }

    /**
     * Makes a controller based on the given options.
     */
    private function makeController(): void
    {
        if ($this->options->hasController()) {
            $this->executeMaker($this->makeController);
        }
    }

    /**
     * Make a request.
     */
    private function makeRequest(): void
    {
        if ($this->options->hasRequest()) {
            $this->executeMaker($this->makeRequest);
        }
    }
}
