import React, { useEffect, useState } from "react";
import { useDebounce } from "@/Hooks/useDebounce";
import { handleError } from "@/Helpers/handleError";
import { ajax } from "@/ajax";

export const withTable = (WrappedComponent, { routeAjaxIndex }) => {
  const WithTable = (props) => {
    const [dataSource, setDataSource] = useState([]);
    const [loading, setLoading] = useState(false);
    const [query, setQuery] = useState({
      page: 1,
      perPage: 5,
      sortKey: "id",
      sortOrder: "asc",
      paginate: true,
      search: "",
    });
    const [pagination, setPagination] = useState({
      current: 1,
      pageSize: 5,
      total: 0,
    });

    const [searchTerm, setSearchTerm] = useState("");
    const debouncedSearchTerm = useDebounce(searchTerm, 800);

    useEffect(() => {
      getData();
    }, [query]);

    const getData = () => {
      setLoading(true);
      ajax
        .get(route(routeAjaxIndex), { params: query })
        .then((res) => {
          setDataSource(res.data.results);
          setPagination({
            current: res.data.pagination.page,
            pageSize: res.data.pagination.perPage,
            total: res.data.pagination.total,
          });
        })
        .catch((err) => handleError(err))
        .finally(() => setLoading(false));
    };

    useEffect(() => {
      setQuery({
        ...query,
        search: debouncedSearchTerm,
      });
    }, [debouncedSearchTerm]);

    const handleSearch = (e) => {
      setSearchTerm(e.target.value);
    };

    const handleChangeTable = (pagination, filters, sorter, extra) => {
      const sort = {
        sortKey: sorter.order ? sorter.columnKey : "id",
        sortOrder: sorter.order === "descend" ? "desc" : "asc",
      };

      setQuery({
        ...query,
        ...sort,
        filters,
        perPage: pagination.pageSize,
        page: pagination.current,
      });

      const { current, pageSize } = pagination;
      setPagination({
        current,
        pageSize,
      });
    };

    return (
      <WrappedComponent
        loading={loading}
        dataSource={dataSource}
        pagination={{
          ...pagination,
          showSizeChanger: true,
          showTotal: (total, range) =>
            `${range[0]}-${range[1]} of ${total} items`,
        }}
        handleSearch={handleSearch}
        handleChangeTable={handleChangeTable}
        getData={getData}
        queryState={{ query, setQuery }}
        {...props}
      />
    );
  };

  // for debugging to show component name
  WithTable.displayName = `WithTable(${getDisplayName(WrappedComponent)})`;

  return WithTable;
};

const getDisplayName = (WrappedComponent) => {
  return WrappedComponent.displayName || WrappedComponent.name || "Component";
};
