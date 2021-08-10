import { Fragment } from 'react';
import cn from 'classnames';
import { Disclosure, Menu, Transition } from '@headlessui/react';
import { SearchIcon } from '@heroicons/react/solid';
import { BellIcon, MenuIcon, XIcon } from '@heroicons/react/outline';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Logo from '@/components/Logo';
import Head from '@/components/layout/Head';

const navigation = [
  {
    label: 'Dashboard',
    routeName: 'dashboard.show'
  },
  {
    label: 'Profile',
    routeName: 'profile.edit'
  },
  {
    label: 'Settings',
    routeName: 'settings.show'
  }
];
const profileNav = [
  {
    label: 'Profile',
    routeName: 'profile.edit'
  },
  {
    label: 'Settings',
    routeName: 'settings.show'
  }
];

export default function Authenticated({ header = null, children }) {
  const { auth, config, meta } = usePage().props;

  return (
    <>
      <Head />

      <div className="min-h-screen bg-gray-100">
        <div className="pb-32 bg-brand-dark">
          <Disclosure
            as="nav"
            className="border-b border-brand-dark-lighten bg-brand-dark lg:border-none"
          >
            {({ open }) => (
              <>
                <div className="px-2 mx-auto max-w-7xl sm:px-4 lg:px-8">
                  <div className="relative flex items-center justify-between h-16 lg:border-b lg:border-brand-dark-lighten">
                    <div className="flex items-center px-2 lg:px-0">
                      <div className="flex-shrink-0">
                        <InertiaLink href="/">
                          <Logo className="h-8 text-white" />
                        </InertiaLink>
                      </div>

                      <div className="hidden lg:block lg:ml-10">
                        <div className="flex space-x-4">
                          {navigation.map(({ routeName, label }) => (
                            <InertiaLink
                              key={routeName}
                              href={route(routeName)}
                              className={cn(
                                'px-3 py-2 text-sm font-medium rounded-md rounded-b-none border-b-2 border-transparent',
                                {
                                  'border-brand-primary bg-brand-dark-darken text-white hover:bg-brand-dark-lighten':
                                    route().current(routeName),
                                  'hover:bg-brand-dark-lighten hover:bg-opacity-75 hover:border-brand-primary text-white':
                                    !route().current(routeName)
                                }
                              )}
                            >
                              {label}
                            </InertiaLink>
                          ))}
                        </div>
                      </div>
                    </div>

                    <div className="flex lg:hidden">
                      {/* Mobile menu button */}
                      <Disclosure.Button className="inline-flex items-center justify-center p-2 text-gray-300 rounded-md bg-brand-dark hover:text-white hover:bg-brand-dark-lighten hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-600 focus:ring-white">
                        <span className="sr-only">Open main menu</span>
                        {open ? (
                          <XIcon className="block w-6 h-6" aria-hidden="true" />
                        ) : (
                          <MenuIcon className="block w-6 h-6" aria-hidden="true" />
                        )}
                      </Disclosure.Button>
                    </div>
                    <div className="hidden lg:block lg:ml-4">
                      <div className="flex items-center">
                        {/* Profile dropdown */}
                        <Menu as="div" className="relative flex-shrink-0 ml-3">
                          {({ open }) => (
                            <>
                              <div>
                                <Menu.Button className="flex text-sm text-white rounded-full bg-brand-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-600 focus:ring-white">
                                  <span className="sr-only">Open user menu</span>
                                  <img
                                    className="w-8 h-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt=""
                                  />
                                </Menu.Button>
                              </div>
                              <Transition
                                show={open}
                                as={Fragment}
                                enter="transition ease-out duration-100"
                                enterFrom="transform opacity-0 scale-95"
                                enterTo="transform opacity-100 scale-100"
                                leave="transition ease-in duration-75"
                                leaveFrom="transform opacity-100 scale-100"
                                leaveTo="transform opacity-0 scale-95"
                              >
                                <Menu.Items
                                  static
                                  className="absolute right-0 w-48 mt-2 text-sm text-gray-700 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                  {profileNav.map(({ routeName, label }, index) => (
                                    <Menu.Item key={routeName}>
                                      {({ active }) => (
                                        <InertiaLink
                                          href={route(routeName)}
                                          className={cn('block py-2 px-4', {
                                            'bg-gray-100': active,
                                            'rounded-t-md': index === 0
                                          })}
                                        >
                                          {label}
                                        </InertiaLink>
                                      )}
                                    </Menu.Item>
                                  ))}

                                  <Menu.Item>
                                    {({ active }) => (
                                      <InertiaLink
                                        method="post"
                                        href={route('logout')}
                                        className={cn(
                                          'block py-2 px-4 rounded-b-md border-t border-gray-200',
                                          {
                                            'bg-gray-100': active
                                          }
                                        )}
                                      >
                                        Sign out
                                      </InertiaLink>
                                    )}
                                  </Menu.Item>
                                </Menu.Items>
                              </Transition>
                            </>
                          )}
                        </Menu>
                      </div>
                    </div>
                  </div>
                </div>

                <Disclosure.Panel className="lg:hidden">
                  <div className="px-2 pt-2 pb-3 space-y-1">
                    {navigation.map(({ routeName, label }) => (
                      <InertiaLink
                        key={routeName}
                        href={route(routeName)}
                        className="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-brand-dark-lighten hover:bg-opacity-75"
                      >
                        {label}
                      </InertiaLink>
                    ))}
                  </div>
                  <div className="pt-4 pb-3 border-t border-brand-primary bg-brand-dark-lighten">
                    <div className="flex items-center px-5">
                      <div className="flex-shrink-0">
                        <img
                          className="w-10 h-10 rounded-full"
                          src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                          alt=""
                        />
                      </div>
                      <div className="ml-3">
                        <div className="text-base font-medium text-white">Tom Cook</div>
                        <div className="text-sm font-medium text-gray-400">tom@example.com</div>
                      </div>
                    </div>
                    <div className="px-2 mt-3 space-y-1 text-base font-medium text-white">
                      {profileNav.map(({ routeName, label }) => (
                        <InertiaLink
                          key={routeName}
                          href={route(routeName)}
                          className="block px-3 py-2 rounded-md hover:bg-brand-dark hover:bg-opacity-75"
                        >
                          {label}
                        </InertiaLink>
                      ))}

                      <InertiaLink
                        method="post"
                        href={route('logout')}
                        className="block px-3 py-2 rounded-md hover:bg-brand-dark hover:bg-opacity-75"
                      >
                        Sign out
                      </InertiaLink>
                    </div>
                  </div>
                </Disclosure.Panel>
              </>
            )}
          </Disclosure>

          {header ? (
            <header className="py-10">
              <div className="px-4 mx-auto text-2xl font-semibold leading-tight text-white max-w-7xl sm:px-6 lg:px-8">
                {header}
              </div>
            </header>
          ) : null}
        </div>

        <main className="px-4 mx-auto -mt-32 sm:px-6 lg:px-8 max-w-7xl">
          <div className="bg-white rounded md:rounded-md lg:rounded-lg lg:shadow-md">
            {children}
          </div>
        </main>
      </div>
    </>
  );
}
