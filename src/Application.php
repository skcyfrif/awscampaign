<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authentication\Middleware\AuthenticationMiddleware;
use Authentication\AuthenticationService;
use Authentication\Authenticator\FormAuthenticator; // Correctly reference FormAuthenticator
use Authentication\PasswordHasher\BcryptPasswordHasher;

/**
 * Application setup class.
 */
class Application extends BaseApplication
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI !== 'cli') {
            FactoryLocator::add(
                'Table',
                (new TableLocator())->allowFallbackClass(false)
            );
        }
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            ->add(new RoutingMiddleware($this))

            // Authentication middleware (add this line)
            ->add(new AuthenticationMiddleware($this->getAuthenticationService()))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            ->add(new BodyParserMiddleware())

            // Cross Site Request Forgery (CSRF) Protection Middleware
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    public function getAuthenticationService(): AuthenticationService
    {
        // Initialize the AuthenticationService
        $authenticationService = new AuthenticationService();
    
        // Define the fields for authentication
        $fields = [
            'username' => 'email',  // You can change 'email' to 'username' or other fields if needed
            'password' => 'password'
        ];
    
        // Load the authenticators (Session and Form)
        $authenticationService->loadAuthenticator('Authentication.Session');
        $authenticationService->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            // 'loginUrl' => '/users/login', // Adjust to your login page URL
        ]);
    
        // Load the identifier (Email and Password)
        $authenticationService->loadIdentifier('Authentication.Password', [
            'fields' => $fields
        ]);
    
        return $authenticationService;
    }
}
