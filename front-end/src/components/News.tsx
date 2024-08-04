import React, { useEffect, useState } from 'react';
import { Disclosure } from '@headlessui/react'
import { MagnifyingGlassIcon } from '@heroicons/react/24/outline'
import axios from 'axios';
import DisplayNews from './DisplayNews';


const navigation = [
    { name: 'World News', href: '#', current: true },
]

const News: React.FC = () => {
    function classNames(...classes: string[]): string {
        return classes.filter(Boolean).join(' ');
    }

    const [searchQuery, setSearchQuery] = useState<string>('');
    const [results, setResults] = useState([]);
    const [loading, setLoading] = useState<boolean>(false);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const delayDebounceFn = setTimeout(() => {
            if (searchQuery) {
                fetchData();
            }
        }, 500); // Delay the API call by 500ms

        return () => clearTimeout(delayDebounceFn);
    }, [searchQuery]);

    const fetchData = async () => {
        setLoading(true);
        setError(null);

        try {
            const response = await axios.get(`http://localhost:8000/api/news/?search=${searchQuery}`);
            setResults(response.data.theGuardian);
            console.log( results);
        } catch (err: any) {
            console.log(err);
            setError('Error fetching data');
        } finally {
            setLoading(false);
        }
    };

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSearchQuery(e.target.value);
    };

    return <>  <div className="min-h-full">
        <Disclosure as="nav" className="bg-gray-800">
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div className="flex h-16 items-center justify-between">
                    <div className="flex items-center">
                        <div className="flex-shrink-0">
                            <img
                                alt="Your Company"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                className="h-8 w-8"
                            />
                        </div>
                        <div className="hidden md:block">
                            <div className="ml-10 flex items-baseline space-x-4">
                                {navigation.map((item) => (
                                    <a
                                        key={item.name}
                                        href={item.href}
                                        aria-current={item.current ? 'page' : undefined}
                                        className={classNames(
                                            item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                            'rounded-md px-3 py-2 text-sm font-medium',
                                        )}
                                    >
                                        {item.name}
                                    </a>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Disclosure>

        <header className="bg-white shadow">
            <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div className="flex flex-1 justify-start px-2 lg:ml-6">
                    <div className="w-full max-w-lg lg:max-w-xs">
                        <label htmlFor="search" className="sr-only">
                            Search News Around The World
                        </label>
                        <div className="relative text-gray-400 focus-within:text-gray-600">
                            <div className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <MagnifyingGlassIcon aria-hidden="true" className="h-5 w-5" />
                            </div>
                            <input
                                id="search"
                                name="search"
                                type="search"
                                value={searchQuery}
                                onChange={handleInputChange}
                                placeholder="Search News Around The World !"
                                className="block w-full rounded-md border-2 bg-white py-1.5 pl-10 pr-3 text-gray-900 focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">{/* Your content */}
                {loading && <p>Loading...</p>}
                {error && <p>{error}</p>}
                {results.length > 0 && (
                    <DisplayNews results={results}/>
                )}
            </div>
        </main>
    </div>
    </>
};

export default News;
