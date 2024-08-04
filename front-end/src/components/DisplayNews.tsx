

interface News {
    results: any;
}

const DisplayNews: React.FC<News> = ({ results }) => {
    return (
        <ul role="list" className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {results.map((person: any, index: number) => (
                <li key={index} className="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                    <div className="flex w-full items-center justify-between space-x-6 p-6">
                        <div className="flex-1 truncate">
                            <div className="flex items-center space-x-3">
                                <h3 className="truncate text-sm font-medium text-gray-900">{person.section}</h3>
                                <span className="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                    {person.newsSource}
                                </span>
                            </div>
                            <p className="mt-1 truncate text-sm text-gray-500">{person.title}</p>
                            <p className="mt-1 truncate text-sm text-gray-500">{person.publicationDate}</p>
                        </div>
                        <img alt="" src={person.thumbnail} className="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" />
                    </div>
                </li>
            ))}
        </ul>
    )
}

export default DisplayNews;
