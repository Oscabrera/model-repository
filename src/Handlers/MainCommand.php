<?php

namespace Oscabrera\ModelRepository\Handlers;

use Oscabrera\ModelRepository\Classes\Options;
use Oscabrera\ModelRepository\Exception\CreateStructureException;
use Oscabrera\ModelRepository\Exception\StubException;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\Factory;

class MainCommand
{
    /**
     * @var Factory
     */
    protected Factory $output;

    /**
     * @var Command $command
     */
    protected Command $command;

    /**
     * @var Options
     */
    protected Options $options;

    /**
     * @var string
     */
    protected string $name;

    /**
     * Constructor for the class.
     *
     * @param MakeModel $makeModel The MakeModel instance.
     * @param MakeRepository $makeRepository The MakeRepository instance.
     * @param MakeService $makeService The MakeService instance.
     * @param MakeInterface $makeInterface The MakeInterface instance.
     * @param MakeSeeder $makeSeeder The MakeSeeder instance.
     */
    public function __construct(
        protected MakeModel $makeModel,
        protected MakeRepository $makeRepository,
        protected MakeService $makeService,
        protected MakeInterface $makeInterface,
        protected MakeController $makeController,
        protected MakeSeeder $makeSeeder
    ) {
    }


    /**
     * Sets the output object to be used for displaying messages.
     *
     * @param Factory $output The output object to be set.
     * @return void
     */
    public function setOutput(Factory $output): void
    {
        $this->output = $output;
    }

    public function handle(Command $command, string $name, Options $options): void
    {
        $this->command = $command;
        $this->name = $name;
        $this->options = $options;
        $this->getOptions();
        $this->run();
    }

    /**
     * Retrieves the options from the command line arguments and assigns them to the corresponding properties.
     *
     * This method checks for the presence of specific options and assigns the corresponding values to the
     * properties of the class instance.
     *
     * @return void
     */
    private function getOptions(): void
    {
        $this->options->hasSeeder = boolval($this->command->option('seed'));
        $this->options->hasMigration = boolval($this->command->option('migration'));
        $this->options->hasService = boolval($this->command->option('service'));
        $this->options->hasController = boolval($this->command->option('controller'));
        $this->options->hasRequest = boolval($this->command->option('request'));
        $this->options->hasResource = boolval($this->command->option('resource'));
        $this->options->hasCollection = boolval($this->command->option('collection'));
    }

    /**
     * Executes the series of commands to generate the necessary files for a given resource.
     *
     * @return void
     */
    public function run(): void
    {
        $this->makeModel();
        $this->makeRepository();
        $this->makeInterface();
        $this->makeService();
        $this->makeController();
        $this->makeResource();
        $this->makeCollection();
        $this->makeRequest();
    }

    /**
     * Displays an info message about a command.
     *
     * @param array{type: string, path: string} $info
     *
     * @return void
     */
    public function infoCommand(array $info): void
    {
        $this->output->info(sprintf('%s [%s] created successfully.', $info['type'], $info['path']));
    }

    /**
     * Displays an error message.
     *
     * @param string $message The error message to be displayed.
     * @param array{type: string, path: string} $info Additional information about the error.
     * @return void
     */
    public function errorCommand(string $message, array $info): void
    {
        $this->output->error(sprintf('%s %s', $info['type'], $message));
    }

    /**
     * Creates a model based on the given name and options.
     *
     * @return void
     */
    private function makeModel(): void
    {
        $this->makeModel->make($this->command, $this->name, $this->options->hasMigration, $this->options->hasSeeder);
    }

    /**
     * Make a repository with the given name.
     *
     * @return void
     */
    private function makeRepository(): void
    {
        try {
            $result = $this->makeRepository->make($this->name);
        } catch (StubException|CreateStructureException $exception) {
            $info = $exception->getInput();
            /** @var array{type: string, path: string} $info */
            $this->errorCommand($exception->getMessage(), $info);
            return;
        }
        $this->infoCommand($result);
    }

    /**
     * Makes a service.
     *
     * @return void
     */
    private function makeService(): void
    {
        if (!$this->options->hasService) {
            return;
        }
        try {
            $result = $this->makeService->make($this->name);
        } catch (StubException|CreateStructureException $exception) {
            $info = $exception->getInput();
            /** @var array{type: string, path: string} $info */
            $this->errorCommand($exception->getMessage(), $info);
            return;
        }
        $this->infoCommand($result);
    }

    /**
     * Create an interface if the options flag hasInterface is true.
     *
     * @return void
     */
    private function makeInterface(): void
    {
        if (!$this->options->hasService) {
            return;
        }
        try {
            $result = $this->makeInterface->make($this->name);
        } catch (StubException|CreateStructureException $exception) {
            $info = $exception->getInput();
            /** @var array{type: string, path: string} $info */
            $this->errorCommand($exception->getMessage(), $info);
            return;
        }
        $this->infoCommand($result);
    }

    /**
     * Generates a controller.
     *
     * @return void
     */
    private function makeController(): void
    {
        if (!$this->options->hasController) {
            return;
        }
        try {
            $result = $this->makeController->make($this->name);
        } catch (StubException|CreateStructureException $exception) {
            $info = $exception->getInput();
            /** @var array{type: string, path: string} $info */
            $this->errorCommand($exception->getMessage(), $info);
            return;
        }
        $this->infoCommand($result);
    }

    /**
     * Makes a resource.
     *
     * If the options "hasResource" is set to true,
     * the method calls the "make:resource" command with the name of the resource.
     *
     * @return void
     */
    private function makeResource(): void
    {
        if (!$this->options->hasResource) {
            return;
        }
        $this->command->call('make:resource', ['name' => "{$this->name}\\{$this->name}Resource"]);
    }

    /**
     * Make a collection resource.
     *
     * @return void
     */
    private function makeCollection(): void
    {
        if (!$this->options->hasCollection) {
            return;
        }
        $this->command->call('make:resource', ['name' => "{$this->name}\\{$this->name}Collection"]);
    }

    /**
     * Makes a request if the options haveRequest is set to true.
     *
     * @void
     */
    private function makeRequest(): void
    {
        if (!$this->options->hasRequest) {
            return;
        }
        $this->command->call('make:request', ['name' => "{$this->name}\\{$this->name}Request"]);
    }
}
