<?php

namespace ModelRepository\Handlers;

use ModelRepository\Classes\Options;
use ModelRepository\Exception\StubException;
use Illuminate\Console\Command;

class MainCommand
{
    public function __construct(
        protected MakeModel $makeModel,
        protected MakeRepository $makeRepository,
        protected MakeService $makeService,
        protected MakeInterface $makeInterface
    ) {
    }

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
        $this->options->hasMigration = $this->command->option('migration') ?? false;
        $this->options->hasInterface = $this->command->option('interface') ?? false;
        $this->options->hasService = $this->command->option('service') ?? false;
        $this->options->hasController = $this->command->option('controller') ?? false;
        $this->options->hasRequest = $this->command->option('request') ?? false;
        $this->options->hasResource = $this->command->option('resource') ?? false;
        $this->options->hasCollection = $this->command->option('collection') ?? false;
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
     * Outputs an information message or an error message based on the provided message string.
     *
     * @param string $message The message to be displayed.
     *
     * @return void
     */
    private function infoCommand(string $message): void
    {
        $message ? $this->command->info($message) : $this->command->error('Failed to create element.');
    }

    /**
     * Creates a model based on the given name and options.
     *
     * @return void
     */
    private function makeModel(): void
    {
        $this->makeModel->make($this->command, $this->name, $this->options->hasMigration);
        $this->infoCommand('Model created successfully.');
    }

    /**
     * Make a repository with the given name.
     *
     * @return void
     */
    private function makeRepository(): void
    {
        $result = '';
        try {
            $result = $this->makeRepository->make($this->name);
        } catch (StubException $exception) {
            $this->command->error($exception->getMessage());
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
        $result = '';
        try {
            $result = $this->makeService->make($this->name, $this->options->hasInterface);
        } catch (StubException $exception) {
            $this->command->error($exception->getMessage());
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
        if (!$this->options->hasInterface) {
            return;
        }
        $result = '';
        try {
            $result = $this->makeInterface->make($this->name);
        } catch (StubException $exception) {
            $this->command->error($exception->getMessage());
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
        $this->command->call('make:controller', ['name' => "{$this->name}\\{$this->name}Controller"]);
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